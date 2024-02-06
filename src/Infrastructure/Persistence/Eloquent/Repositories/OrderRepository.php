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
        return OrderData::fromArray(
            $this->model->create($order->toArray())->toArray()
        );
    }

    public function attachProducts(int $orderId, OrderProductCollection $orderProducts): bool
    {
        return (bool) $this->model->newQueryWithoutScopes()
            ->find($orderId)
            ->products()
            ->attach($orderProducts->map->toArray()->all());
    }

    public function findByIdentify(
        string $identify,
        array $with = []
    ): OrderData {
        return OrderData::fromArray(
            $this->model->newQueryWithoutScopes()
                ->with($with)
                ->where('identify', $identify)
                ->firstOrFail()
                ->toArray()
        );
    }

    public function queryByClientId(int $clientId, array $withRelations = []): OrderCollection
    {
        return OrderCollection::fromArray(
            $this->model->newQueryWithoutScopes()
                ->select()
                ->with($withRelations)
                ->where('client_id', $clientId)
                ->get()
                ->toArray()
        );
    }

    public function checksIfOrderExistsByIdentifier(string $identify): bool
    {
        return $this->model->newQueryWithoutScopes()
            ->where('identify', $identify)
            ->exists();
    }
}
