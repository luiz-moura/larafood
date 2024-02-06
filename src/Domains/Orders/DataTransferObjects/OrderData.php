<?php

namespace Domains\Orders\DataTransferObjects;

use DateTime;
use Domains\ACL\Clients\DataTransferObjects\ClientData;
use Domains\Evaluations\DataTransferObjects\EvaluationCollection;
use Domains\Evaluations\DataTransferObjects\EvaluationData;
use Domains\Orders\Enums\OrderStatusEnum;
use Domains\Products\DataTransferObjects\ProductCollection;
use Domains\Tables\DataTransferObjects\TableData;
use Infrastructure\Shared\DataTransferObject;

class OrderData extends DataTransferObject
{
    public int $id;
    public int $tenant_id;
    public ?int $table_id;
    public ?int $client_id;
    public string $identify;
    public float $total;
    public ?string $comment;
    public OrderStatusEnum $status;
    public DateTime $created_at;
    public ?DateTime $updated_at;
    public ?ClientData $client;
    public ?TableData $table;
    public ?ProductCollection $products;
    public ?EvaluationCollection $evaluations;

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            tenant_id: $data['tenant_id'],
            table_id: $data['table_id'] ?? null,
            client_id: $data['client_id'] ?? null,
            identify: $data['identify'],
            total: $data['total'],
            comment: $data['comment'] ?? null,
            status: OrderStatusEnum::from($data['status']),
            created_at: date_create($data['created_at']),
            updated_at: $data['updated_at'] ? date_create($data['updated_at']) : null,
            client: isset($data['client']) ? ClientData::fromArray($data['client']) : null,
            table: isset($data['table']) ? TableData::fromArray($data['table']) : null,
            products: isset($data['products']) ? ProductCollection::fromArray($data['products']) : null,
            evaluations: isset($data['evaluations']) ? EvaluationData::fromArray($data['evaluations']) : null,
        );
    }
}
