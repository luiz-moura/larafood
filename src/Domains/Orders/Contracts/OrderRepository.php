<?php

namespace Domains\Orders\Contracts;

use Domains\Orders\DataTransferObjects\OrderCollection;
use Domains\Orders\DataTransferObjects\OrderData;
use Domains\Orders\DataTransferObjects\OrderProductCollection;
use Domains\Orders\DataTransferObjects\StoreOrderData;

interface OrderRepository
{
    public function create(StoreOrderData $order): OrderData;
    public function checksIfOrderExistsByIdentifier(string $identify): bool;
    public function attachProducts(int $id, OrderProductCollection $orderProducts): bool;
    public function findByIdentify(string $identify, array $with = []): OrderData;
    public function queryByClientId(int $clientId, array $withRelations = []): OrderCollection;
}
