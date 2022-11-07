<?php

namespace Interfaces\Http\Profiles\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class ProfileFormData extends DataTransferObject
{
    public string $name;
    public ?string $description;
}
