<?php

namespace Interfaces\Http\Tables\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class TableFormData extends DataTransferObject
{
    public string $identify;
    public ?string $description;
}
