<?php

namespace Domains\Orders\DataTransferObjects;

use Domains\Products\DataTransferObjects\ProductData;
use Infrastructure\Shared\DataTransferObject;

class ProductWithQuantityData extends DataTransferObject
{
    public ProductData $product;
    public int $quantity;

    public static function fromArray(array $data): self
    {
        return new self(
            product: $data['product'],
            quantity: $data['quantity'],
        );
    }
}
