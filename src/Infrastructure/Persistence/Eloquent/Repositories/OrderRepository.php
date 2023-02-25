<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Orders\Contracts\OrderRepository as OrderRepositoryContract;
use Domains\Orders\DataTransferObjects\OrderData;
use Infrastructure\Persistence\Eloquent\Models\Order;
use Infrastructure\Shared\AbstractRepository;
use Interfaces\Http\Api\Order\DataTransferObjects\CreateOrderData;

class OrderRepository extends AbstractRepository implements OrderRepositoryContract
{
    protected $modelClass = Order::class;

    public function create(CreateOrderData $order): OrderData
    {
        return OrderData::fromModel(
            $this->model->create(
                $order->toArray()
            )
        );
    }

    public function findByIdentifyAndTenantUuid(string $identify, string $companyToken): OrderData
    {
        return OrderData::fromModel(
            $this->model->newQueryWithoutScopes()
                ->where('flag', $identify)
                ->whereRelation('tenant', 'uuid', $companyToken)
                ->firstOrFail()
        );
    }

    public function checksIfOrderExistsByIdentifier(string $identify): bool
    {
        return $this->model->where('identify', $identify)->exists();
    }
}
