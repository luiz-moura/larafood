<?php

namespace Domains\Orders\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class OrderProductData extends DataTransferObject
{
    public int $product_id;
    public int $quantity;
    public float $price;

    public static function fromArray(array $data): self
    {
        return new self(
            product_id: $data['product_id'],
            quantity: $data['quantity'],
            price: $data['price'],
        );
    }
}
