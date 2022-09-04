<?php

namespace Domains\ACL\Users\DataTransferObjects;

use Illuminate\Support\Collection;
use Infrastructure\Persistence\Eloquent\Models\User;

class UsersModelCollection extends Collection
{
    public static function createFromModel(Collection $collection): self
    {
        return new self($collection->map(
            fn (User $item) => UsersModelData::createFromModel($item)
        ));
    }

    public static function createFromArray(array $data): self
    {
        return new self(array_map(
            fn (array $item) => UsersModelData::createFromArray($item),
            $data
        ));
    }
}
