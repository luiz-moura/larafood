<?php

namespace Domains\Orders\UseCases;

use Domains\ACL\Clients\DataTransferObjects\ClientData;
use Domains\Orders\Actions\AttachProductsToOrderAction;
use Domains\Orders\Actions\CalculateOrderTotalAction;
use Domains\Orders\Actions\GenerateUniqueIdentifierAction;
use Domains\Orders\Actions\StoreOrderAction;
use Domains\Orders\DataTransferObjects\OrderData;
use Domains\Orders\DataTransferObjects\ProductWithQuantityCollection;
use Domains\Orders\DataTransferObjects\StoreOrderData;
use Domains\Orders\Enums\OrderStatusEnum;
use Domains\Products\Actions\QueryProductsByUuidAndTenantUuidAction;
use Domains\Tables\Actions\FindTableByUuidAndTenantUuidAction;
use Domains\Tenants\Actions\FindTenantByUuidAction;
use Interfaces\Http\Api\Order\DataTransferObjects\OrderFormData;

class CreateOrderUseCase
{
    public function __construct(
        private FindTenantByUuidAction $findTenantByUuidAction,
        private FindTableByUuidAndTenantUuidAction $findTableByUuidAndTenantUuidAction,
        private QueryProductsByUuidAndTenantUuidAction $queryProductsByUuidAction,
        private GenerateUniqueIdentifierAction $generateUniqueIdentifierAction,
        private CalculateOrderTotalAction $calculateOrderTotalAction,
        private StoreOrderAction $storeOrderAction,
        private AttachProductsToOrderAction $attachProductsToOrderAction,
    ) {
    }

    public function __invoke(OrderFormData $orderForm, string $companyToken, ?ClientData $client = null): OrderData
    {
        $productIdentification = $orderForm->products->pluck('identify')->toArray();
        $products = ($this->queryProductsByUuidAction)($productIdentification, $companyToken);
        $productsWithQuantity = ProductWithQuantityCollection::fromArray(
            $products->map(fn ($product) => [
                'product' => $product,
                'quantity' => $orderForm->products->firstWhere('identify', $product->uuid)->quantity,
            ])->toArray()
        );
        $orderAmount = ($this->calculateOrderTotalAction)($productsWithQuantity);

        $tenantId = ($this->findTenantByUuidAction)($companyToken)->id;
        $table = $orderForm->tableUuid ? ($this->findTableByUuidAndTenantUuidAction)($orderForm->tableUuid, $companyToken) : null;
        $identify = ($this->generateUniqueIdentifierAction)();

        $createOrderData = new StoreOrderData(
            tenant_id: $tenantId,
            table_id: $table?->id,
            client_id: $client?->id,
            comment: $orderForm->comment,
            identify: $identify,
            total: $orderAmount,
            status: OrderStatusEnum::OPEN,
        );

        $order = ($this->storeOrderAction)($createOrderData);
        ($this->attachProductsToOrderAction)($order->id, $productsWithQuantity);
        $order->products = $products;
        $order->table = $table;
        $order->client = $client;

        return $order;
    }
}
