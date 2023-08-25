<?php

namespace Domains\Orders\DataTransferObjects;

use Domains\Orders\Enums\OrderStatusEnum;
use Infrastructure\Shared\DataTransferObject;

class StoreOrderData extends DataTransferObject
{
    public int $tenant_id;
    public ?int $table_id;
    public ?int $client_id;
    public ?string $comment;
    public string $identify;
    public float $total;
    public OrderStatusEnum $status;
}
