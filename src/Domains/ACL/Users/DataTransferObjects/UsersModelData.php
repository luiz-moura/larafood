<?php

namespace Domains\ACL\Users\DataTransferObjects;

use Infrastructure\Persistence\Eloquent\Models\User;
use Infrastructure\Shared\DataTransferObject;

class UsersModelData extends DataTransferObject
{
    public string $name;
    public string $email;
    public string $created_at;
    public string $updated_at;

    public static function createFromModel(User $user): self
    {
        return new self([
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ] + $user->toArray());
    }
}
