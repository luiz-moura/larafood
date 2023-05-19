<?php

namespace Domains\Orders\Contracts;

use Domains\Orders\DataTransferObjects\OrderCollection;
use Domains\Orders\DataTransferObjects\OrderData;
use Interfaces\Http\Api\Order\DataTransferObjects\OrderFormData;
use Interfaces\Http\Api\Order\DataTransferObjects\OrderProductFormCollection;

interface OrderRepository
{
    public function create(OrderFormData $order): OrderData;
    public function checksIfOrderExistsByIdentifier(string $identify): bool;
    public function attachProducts(int $id, OrderProductFormCollection $orderProducts): bool;
    public function findByIdentifyAndTenantUuid(string $identify, string $companyToken, array $with = []): OrderData;
    public function queryByClientId(int $clientId): OrderCollection;
}
