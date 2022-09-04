<?php

namespace Domains\ACL\Users\DataTransferObjects;

use Domains\Tenants\DataTransferObjects\TenantsModelData;
use Infrastructure\Persistence\Eloquent\Models\User;
use Infrastructure\Shared\DataTransferObject;

class UsersModelData extends DataTransferObject
{
    public int $id;
    public string $name;
    public string $email;
    public string $created_at;
    public string $updated_at;
    public ?TenantsModelData $tenant;

    public static function createFromModel(User $user): self
    {
        return new self([
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'tenant' => $user->tenant ? TenantsModelData::createFromModel($user->tenant) : null,
        ] + $user->toArray());
    }

    public static function createFromArray(array $data): self
    {
        return new self([
            'created_at' => date_create($data['created_at']),
            'updated_at' => $data['updated_at'] ? date_create($data['updated_at']) : null,
            'tenant' => $data['tenant'] ? TenantsModelData::createFromArray($data['tenant']) : null,
        ] + $data);
    }
}
