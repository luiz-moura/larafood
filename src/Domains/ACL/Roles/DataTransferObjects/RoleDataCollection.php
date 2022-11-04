<?php

namespace Domains\ACL\Roles\DataTransferObjects;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Infrastructure\Persistence\Eloquent\Models\Role;

class RoleDataCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(
            array_map(
                fn (array $item) => RoleData::fromArray($item),
                $data
            )
        );
    }

    public static function fromModel(EloquentCollection|Collection $collection)
    {
        return $collection->map(
            fn (Role $role) => RoleData::fromModel($role)
        );
    }
}
