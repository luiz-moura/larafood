<?php

namespace Interfaces\Http\Permissions\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class PermissionFormData extends DataTransferObject
{
    public string $name;
    public ?string $description;

    public static function fromRequest(array $data): self
    {
        return new self($data);
    }
}
