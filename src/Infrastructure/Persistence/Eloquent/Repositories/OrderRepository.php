<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Orders\Contracts\OrderRepository as OrderRepositoryContract;
use Domains\Orders\DataTransferObjects\OrderCollection;
use Domains\Orders\DataTransferObjects\OrderData;
use Domains\Orders\DataTransferObjects\OrderProductCollection;
use Domains\Orders\DataTransferObjects\StoreOrderData;
use Infrastructure\Persistence\Eloquent\Models\Order;
use Infrastructure\Shared\AbstractRepository;

class OrderRepository extends AbstractRepository implements OrderRepositoryContract
{
    protected $modelClass = Order::class;

    public function create(StoreOrderData $order): OrderData
    {
        return OrderData::fromModel(
            $this->model->create($order->toArray())
        );
    }

    public function attachProducts(int $orderId, OrderProductCollection $orderProducts): bool
    {
        return (bool) $this->model->newQueryWithoutScopes()
            ->find($orderId)
            ->products()
            ->attach($orderProducts->map->toArray()->all());
    }

    public function findByIdentifyAndTenantUuid(
        string $identify,
        string $companyToken,
        array $with = []
    ): OrderData {
        return OrderData::fromModel(
            $this->model->newQueryWithoutScopes()
                ->with($with)
                ->where('identify', $identify)
                ->whereRelation('tenant', 'uuid', $companyToken)
                ->firstOrFail()
        );
    }

    public function queryByClientId(int $clientId): OrderCollection
    {
        return OrderCollection::fromModelCollection(
            $this->model->newQueryWithoutScopes()
                ->select()
                ->where('client_id', $clientId)
                ->get()
        );
    }

    public function checksIfOrderExistsByIdentifier(string $identify): bool
    {
        return $this->model->newQueryWithoutScopes()
            ->where('identify', $identify)
            ->exists();
    }
}
