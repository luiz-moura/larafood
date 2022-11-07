<?php

namespace Interfaces\Http\Categories\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class CategoryFormData extends DataTransferObject
{
    public string $name;
    public string $description;
}
