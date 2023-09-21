<?php

namespace Domains\ACL\Permissions\DataTransferObjects;

use Illuminate\Support\Collection;

class PermissionCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => PermissionData::fromArray($item), $data)
        );
    }
}
