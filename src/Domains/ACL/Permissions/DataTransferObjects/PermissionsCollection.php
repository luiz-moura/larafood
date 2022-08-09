<?php

namespace Domains\ACL\Permissions\DataTransferObjects;

use Illuminate\Support\Collection;

class PermissionsCollection extends Collection
{
    public static function createFromArray(array $data): self
    {
        return new self(array_map(
            fn (array $item) => PermissionsData::createFromArray($item),
            $data
        ));
    }
}
