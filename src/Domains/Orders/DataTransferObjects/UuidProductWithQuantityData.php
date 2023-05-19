<?php

namespace Domains\Orders\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class UuidProductWithQuantityData extends DataTransferObject
{
    public string $uuid;
    public int $quantity;

    public static function fromArray(array $data): self
    {
        return new self([
            'uuid' => $data['uuid'] ?? $data['identify'],
            'quantity' => $data['quantity'],
        ]);
    }
}
