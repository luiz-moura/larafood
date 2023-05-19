<?php

namespace Interfaces\Http\Api\Order\Controllers;

use Domains\Orders\Actions\AttachProductsToOrderAction;
use Domains\Orders\Actions\CalculateOrderTotalAction;
use Domains\Orders\Actions\CreateOrderAction;
use Domains\Orders\Actions\FindOrderByUuidAndTenantUuidAction;
use Domains\Orders\Actions\GenerateUniqueIdentifierAction;
use Domains\Orders\Actions\QueryOrdersByClientIdAction;
use Domains\Orders\DataTransferObjects\ProductWithQuantityCollection;
use Domains\Orders\DataTransferObjects\UuidProductWithQuantityCollection;
use Domains\Orders\Enums\OrderStatusEnum;
use Domains\Products\Actions\QueryProductsByUuidAction;
use Domains\Tables\Actions\FindTableByUuidAndTenantUuidAction;
use Domains\Tenants\Actions\FindTenantByUuidAction;
use Illuminate\Support\Arr;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Api\Order\DataTransferObjects\OrderFormData;
use Interfaces\Http\Api\Order\DataTransferObjects\OrderProductFormCollection;
use Interfaces\Http\Api\Order\Requests\StoreOrderRequest;
use Interfaces\Http\Api\Order\Resources\OrderResource;

class OrderController extends Controller
{
    public function store(
        string $companyToken,
        StoreOrderRequest $request,
        FindTenantByUuidAction $findTenantByUuidAction,
        FindTableByUuidAndTenantUuidAction $findTableByUuidAndTenantUuidAction,
        QueryProductsByUuidAction $queryProductsByUuidAction,
        GenerateUniqueIdentifierAction $generateUniqueIdentifierAction,
        CalculateOrderTotalAction $calculateOrderTotalAction,
        CreateOrderAction $createOrderAction,
        AttachProductsToOrderAction $attachProductsToOrderAction,
    ) {
        $validatedRequest = $request->validated();
        $clientId = auth()->user()?->id;
        $tenantId = $findTenantByUuidAction($companyToken)->id;
        $identify = $generateUniqueIdentifierAction();
        $tableId = isset($validatedRequest['table'])
            ? $findTableByUuidAndTenantUuidAction($validatedRequest['table'], $companyToken)->id
            : null;

        $uuidAndQuantityOfProducts = UuidProductWithQuantityCollection::fromArray($validatedRequest['products']);
        $products = $queryProductsByUuidAction($uuidAndQuantityOfProducts->pluck('uuid')->toArray());

        $productsWithQuantity = ProductWithQuantityCollection::fromArray(
            $products->map(fn ($product) => [
                'product' => $product,
                'quantity' => $uuidAndQuantityOfProducts->firstWhere('uuid', $product->uuid)->quantity,
            ])->toArray()
        );

        $total = $calculateOrderTotalAction($productsWithQuantity);

        $createOrderData = new OrderFormData(
            tenant_id: $tenantId,
            table_id: $tableId,
            client_id: $clientId,
            comment: Arr::get($validatedRequest, 'comment'),
            identify: $identify,
            total: $total,
            status: OrderStatusEnum::OPEN,
        );

        $order = $createOrderAction($createOrderData);

        $orderProducts = OrderProductFormCollection::fromArray(
            $productsWithQuantity->map(fn ($productWithQuantity) => [
                'price' => $productWithQuantity->product->price,
                'quantity' => $productWithQuantity->quantity,
                'product_id' => $productWithQuantity->product->id,
            ])->toArray()
        );

        $attachProductsToOrderAction($order->id, $orderProducts);

        return OrderResource::make($order);
    }

    public function show(
        string $companyToken,
        string $identify,
        FindOrderByUuidAndTenantUuidAction $findOrderByUuidAndTenantUuidAction
    ) {
        $order = $findOrderByUuidAndTenantUuidAction(
            $identify,
            $companyToken,
            with: ['client', 'products', 'table']
        );

        return new OrderResource($order);
    }

    public function index(
        string $companyToken,
        QueryOrdersByClientIdAction $queryOrdersByClientIdAction
    ) {
        $clientId = auth()->user()?->id;

        $orders = $queryOrdersByClientIdAction($clientId, $companyToken);

        return OrderResource::collection($orders);
    }
}
