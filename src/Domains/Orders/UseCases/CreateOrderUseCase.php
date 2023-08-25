<?php

namespace Domains\Orders\UseCases;

use Domains\Orders\Actions\AttachProductsToOrderAction;
use Domains\Orders\Actions\CalculateOrderTotalAction;
use Domains\Orders\Actions\GenerateUniqueIdentifierAction;
use Domains\Orders\Actions\StoreOrderAction;
use Domains\Orders\DataTransferObjects\OrderData;
use Domains\Orders\DataTransferObjects\ProductWithQuantityCollection;
use Domains\Orders\DataTransferObjects\StoreOrderData;
use Domains\Orders\Enums\OrderStatusEnum;
use Domains\Products\Actions\QueryProductsByUuidAction;
use Domains\Tables\Actions\FindTableByUuidAndTenantUuidAction;
use Domains\Tenants\Actions\FindTenantByUuidAction;
use Interfaces\Http\Api\Order\DataTransferObjects\OrderFormData;

class CreateOrderUseCase
{
    public function __construct(
        private FindTenantByUuidAction $findTenantByUuidAction,
        private FindTableByUuidAndTenantUuidAction $findTableByUuidAndTenantUuidAction,
        private QueryProductsByUuidAction $queryProductsByUuidAction,
        private GenerateUniqueIdentifierAction $generateUniqueIdentifierAction,
        private CalculateOrderTotalAction $calculateOrderTotalAction,
        private StoreOrderAction $storeOrderAction,
        private AttachProductsToOrderAction $attachProductsToOrderAction,
    ) {
    }

    public function __invoke(OrderFormData $orderForm, string $companyToken, ?int $clientId = null): OrderData
    {
        $products = ($this->queryProductsByUuidAction)($orderForm->products->pluck('identify')->toArray());

        $productsWithQuantity = ProductWithQuantityCollection::fromArray(
            $products->map(fn ($product) => [
                'product' => $product,
                'quantity' => $orderForm->products->firstWhere('identify', $product->uuid)->quantity,
            ])->toArray()
        );

        $tenantId = ($this->findTenantByUuidAction)($companyToken)->id;
        $total = ($this->calculateOrderTotalAction)($productsWithQuantity);
        $identify = ($this->generateUniqueIdentifierAction)();
        $tableId = $orderForm->table_id
            ? ($this->findTableByUuidAndTenantUuidAction)($orderForm->table_id, $companyToken)->id
            : null;

        $createOrderData = new StoreOrderData(
            tenant_id: $tenantId,
            table_id: $tableId,
            client_id: $clientId,
            comment: $orderForm->comment,
            identify: $identify,
            total: $total,
            status: OrderStatusEnum::OPEN,
        );

        $order = ($this->storeOrderAction)($createOrderData);

        ($this->attachProductsToOrderAction)($order->id, $productsWithQuantity);

        return $order;
    }
}
