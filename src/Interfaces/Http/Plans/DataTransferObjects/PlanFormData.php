<?php

namespace Interfaces\Http\Plans\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class PlanFormData extends DataTransferObject
{
    public string $name;
    public float $price;
    public ?string $description;

    public static function fromRequest(array $data): self
    {
        return new self($data);
    }
}
