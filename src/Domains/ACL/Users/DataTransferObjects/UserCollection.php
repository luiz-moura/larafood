<?php

namespace Domains\ACL\Users\DataTransferObjects;

use Illuminate\Support\Collection;
use Infrastructure\Persistence\Eloquent\Models\User;

class UserCollection extends Collection
{
    public static function fromModelCollection(Collection $collection): self
    {
        return new self(
            $collection->map(fn (User $item) => UserData::fromModel($item))
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => UserData::fromArray($item), $data)
        );
    }
}
