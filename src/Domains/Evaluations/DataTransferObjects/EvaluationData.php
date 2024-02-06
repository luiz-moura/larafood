<?php

namespace Domains\Evaluations\DataTransferObjects;

use DateTime;
use Domains\ACL\Clients\DataTransferObjects\ClientData;
use Domains\Orders\DataTransferObjects\OrderData;
use Infrastructure\Shared\DataTransferObject;

class EvaluationData extends DataTransferObject
{
    public int $id;
    public int $stars;
    public int $order_id;
    public int $client_id;
    public ?string $comment;
    public DateTime $created_at;
    public ?DateTime $updated_at;
    public ?ClientData $client;
    public ?OrderData $order;

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            stars: $data['stars'],
            order_id: $data['order_id'],
            client_id: $data['client_id'],
            comment: $data['comment'] ?? null,
            created_at: date_create($data['created_at']),
            updated_at: $data['updated_at'] ? date_create($data['updated_at']) : null,
            client: isset($data['client']) ? ClientData::fromArray($data['client']) : null,
            order: isset($data['order']) ? OrderData::fromArray($data['order']) : null,
        );
    }
}
