<?php

namespace Domains\Orders\Actions;

use Domains\Orders\Contracts\OrderRepository;
use Domains\Orders\DataTransferObjects\OrderCollection;

class QueryOrdersByClientIdAction
{
    public function __construct(private OrderRepository $orderRepository)
    {
    }

    public function __invoke(string $clientId, string $companyToken): OrderCollection
    {
        return $this->orderRepository->queryByClientId($clientId, $companyToken);
    }
}
