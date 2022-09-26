<?php

namespace Interfaces\Http\Products\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class ProductFormData extends DataTransferObject
{
    public string $name;
    public float $price;
    public string $description;
    public ?string $image;

    public static function fromRequest(array $data): self
    {
        return new self($data);
    }
}
