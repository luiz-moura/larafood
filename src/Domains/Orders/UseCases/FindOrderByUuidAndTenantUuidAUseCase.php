<?php

namespace Domains\Orders\UseCases;

use Domains\Orders\Contracts\OrderRepository;
use Domains\Orders\DataTransferObjects\OrderData;
use Domains\Orders\Exceptions\OrderIsNotFromTheCustomerException;

class FindOrderByUuidAndTenantUuidAUseCase
{
    public function __construct(private OrderRepository $orderRepository)
    {
    }

    public function __invoke(string $orderIdentify, array $withRelations = []): OrderData
    {
        $order = $this->orderRepository->findByIdentify($orderIdentify, $withRelations);

        $clientId = auth()->user()->id;
        throw_if(
            $order->client_id && $order->client_id !== $clientId,
            OrderIsNotFromTheCustomerException::class
        );

        return $order;
    }
}
