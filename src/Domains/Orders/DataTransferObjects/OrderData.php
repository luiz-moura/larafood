<?php

namespace Domains\Orders\DataTransferObjects;

use DateTime;
use Domains\ACL\Clients\DataTransferObjects\ClientData;
use Domains\Orders\Enums\OrderStatusEnum;
use Domains\Products\DataTransferObjects\ProductCollection;
use Domains\Tables\DataTransferObjects\TableData;
use Infrastructure\Persistence\Eloquent\Models\Order;
use Infrastructure\Shared\DataTransferObject;

class OrderData extends DataTransferObject
{
    public int $id;
    public int $tenant_id;
    public ?int $table_id;
    public ?int $client_id;
    public ?string $comment;
    public string $identify;
    public float $total;
    public OrderStatusEnum $status;
    public ?ClientData $client;
    public ?TableData $table;
    public ?ProductCollection $products;
    public DateTime $created_at;
    public ?DateTime $updated_at;

    public static function fromModel(Order $model)
    {
        return new self([
            'status' => $model->status,
            'client' => $model->client ? ClientData::fromModel($model->client) : null,
            'table' => $model->table ? TableData::fromModel($model->table) : null,
            'products' => $model->products ? ProductCollection::fromModelCollection($model->products) : null,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ] + $model->toArray());
    }
}
