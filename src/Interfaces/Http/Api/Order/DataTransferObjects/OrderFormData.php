<?php

namespace Interfaces\Http\Api\Order\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class OrderFormData extends DataTransferObject
{
    public ?int $table_id;
    public ?string $comment;
    public OrderProductFormCollection $products;

    public static function fromRequest(array $data): self
    {
        return new self([
            'table_id' => $data['table_id'] ?? null,
            'comment' => $data['comment'] ?? null,
            'products' => OrderProductFormCollection::fromArray($data['products']),
        ]);
    }
}
