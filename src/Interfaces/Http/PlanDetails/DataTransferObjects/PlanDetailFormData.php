<?php

namespace Interfaces\Http\PlanDetails\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class PlanDetailFormData extends DataTransferObject
{
    public string $name;

    public static function fromRequest(array $data): self
    {
        return new self($data);
    }
}
