<?php

namespace Domains\Tenants\DataTransferObjects;

use Illuminate\Database\Eloquent\Collection;

class TenantDataCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => TenantData::fromArray($item), $data)
        );
    }
}
