<?php

namespace Interfaces\Http\Api\Order\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class OrderProductFormData extends DataTransferObject
{
    public string $identify;
    public int $quantity;

    public static function fromArray(array $data): self
    {
        return new self([
            'identify' => $data['identify'],
            'quantity' => $data['quantity'],
        ]);
    }
}
