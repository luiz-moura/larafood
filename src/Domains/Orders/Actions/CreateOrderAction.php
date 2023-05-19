<?php

namespace Domains\Orders\Actions;

use Domains\Orders\Contracts\OrderRepository;
use Domains\Orders\DataTransferObjects\OrderData;
use Interfaces\Http\Api\Order\DataTransferObjects\OrderFormData;

class CreateOrderAction
{
    public function __construct(private OrderRepository $orderRepository)
    {
    }

    public function __invoke(OrderFormData $order): OrderData
    {
        return $this->orderRepository->create($order);
    }
}
