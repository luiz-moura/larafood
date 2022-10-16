<?php

namespace Domains\Tenants\DataTransferObjects;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Infrastructure\Persistence\Eloquent\Models\Tenant;

class TenantDataCollection extends Collection
{
    public static function fromModelCollection(Collection|SupportCollection $collection): self
    {
        return new self(
            $collection->map(fn (Tenant $item) => TenantData::fromModel($item))
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => TenantData::fromArray($item), $data)
        );
    }
}
