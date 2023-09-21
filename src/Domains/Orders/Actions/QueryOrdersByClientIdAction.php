<?php

namespace Domains\Orders\Actions;

use Domains\Orders\Contracts\OrderRepository;
use Domains\Orders\DataTransferObjects\OrderCollection;

class QueryOrdersByClientIdAction
{
    public function __construct(private OrderRepository $orderRepository)
    {
    }

    public function __invoke(string $clientId, array $withRelations = []): OrderCollection
    {
        return $this->orderRepository->queryByClientId($clientId, $withRelations);
    }
}
