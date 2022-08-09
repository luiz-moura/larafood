<?php

namespace Domains\ACL\Profiles\DataTransferObjects;

use Illuminate\Support\Collection;

class ProfilesCollection extends Collection
{
    public static function createFromArray(array $data): self
    {
        return new self(array_map(
            fn (array $item) => ProfilesData::createFromArray($item),
            $data
        ));
    }
}
