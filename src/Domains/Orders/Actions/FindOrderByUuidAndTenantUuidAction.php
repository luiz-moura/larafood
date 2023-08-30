<?php

namespace Domains\Orders\Actions;

use Domains\Orders\Contracts\OrderRepository;
use Domains\Orders\DataTransferObjects\OrderData;

class FindOrderByUuidAndTenantUuidAction
{
    public function __construct(private OrderRepository $orderRepository)
    {
    }

    public function __invoke(string $orderIdentify, string $companyToken, array $withRelations = []): OrderData
    {
        return $this->orderRepository->findByIdentifyAndTenantUuid($orderIdentify, $companyToken, $withRelations);
    }
}
