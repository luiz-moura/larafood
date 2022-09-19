<?php

namespace Domains\ACL\Profiles\DataTransferObjects;

use Illuminate\Support\Collection;

class ProfileCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(
            array_map(
                fn (array $item) => ProfileData::fromArray($item),
                $data
            )
        );
    }
}
