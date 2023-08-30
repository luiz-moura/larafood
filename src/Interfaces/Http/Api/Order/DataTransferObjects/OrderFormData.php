<?php

namespace Interfaces\Http\Api\Order\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class OrderFormData extends DataTransferObject
{
    public ?string $tableUuid;
    public ?string $comment;
    public OrderProductFormCollection $products;

    public static function fromRequest(array $data): self
    {
        return new self([
            'tableUuid' => $data['table'] ?? null,
            'comment' => $data['comment'] ?? null,
            'products' => OrderProductFormCollection::fromArray($data['products']),
        ]);
    }
}
