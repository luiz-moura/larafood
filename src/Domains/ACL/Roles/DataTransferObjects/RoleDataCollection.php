<?php

namespace Domains\ACL\Roles\DataTransferObjects;

use Illuminate\Support\Collection;

class RoleDataCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => RoleData::fromArray($item), $data)
        );
    }
}
