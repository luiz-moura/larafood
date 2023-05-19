<?php

namespace Domains\Orders\Actions;

use Domains\Orders\Contracts\OrderRepository;
use Interfaces\Http\Api\Order\DataTransferObjects\OrderProductFormCollection;

class AttachProductsToOrderAction
{
    public function __construct(private OrderRepository $orderRepository)
    {
    }

    public function __invoke(int $orderId, OrderProductFormCollection $orderProducts): void
    {
        $this->orderRepository->attachProducts($orderId, $orderProducts);
    }
}
