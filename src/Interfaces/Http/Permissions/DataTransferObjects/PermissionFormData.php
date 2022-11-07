<?php

namespace Interfaces\Http\Permissions\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class PermissionFormData extends DataTransferObject
{
    public string $name;
    public ?string $description;
}
