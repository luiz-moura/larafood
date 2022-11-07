<?php

namespace Interfaces\Http\Roles\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class RoleFormData extends DataTransferObject
{
    public string $name;
    public ?string $description;
}
