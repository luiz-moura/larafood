<?php

namespace Domains\Orders\Contracts;

use Domains\Orders\DataTransferObjects\OrderData;
use Interfaces\Http\Api\Order\DataTransferObjects\CreateOrderData;

interface OrderRepository
{
    public function create(CreateOrderData $order): OrderData;
    public function checksIfOrderExistsByIdentifier(string $identify): bool;
    public function findByIdentifyAndTenantUuid(string $identify, string $companyToken): OrderData;
}
