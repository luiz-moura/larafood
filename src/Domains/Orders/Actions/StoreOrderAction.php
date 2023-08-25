<?php

namespace Domains\Orders\Actions;

use Domains\Orders\Contracts\OrderRepository;
use Domains\Orders\DataTransferObjects\OrderData;
use Domains\Orders\DataTransferObjects\StoreOrderData;

class StoreOrderAction
{
    public function __construct(private OrderRepository $orderRepository)
    {
    }

    public function __invoke(StoreOrderData $order): OrderData
    {
        return $this->orderRepository->create($order);
    }
}
