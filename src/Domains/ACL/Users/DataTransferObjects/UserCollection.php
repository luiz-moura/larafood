<?php

namespace Domains\ACL\Users\DataTransferObjects;

use Illuminate\Support\Collection;

class UserCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => UserData::fromArray($item), $data)
        );
    }
}
