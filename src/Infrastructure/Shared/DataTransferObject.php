<?php

namespace Infrastructure\Shared;

use Spatie\DataTransferObject\DataTransferObject as DTO;

abstract class DataTransferObject extends DTO
{
    public static function fromRequest(array $data): self
    {
        return new static($data);
    }
}
