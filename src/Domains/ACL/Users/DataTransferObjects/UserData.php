<?php

namespace Domains\ACL\Users\DataTransferObjects;

use DateTime;
use Domains\Tenants\DataTransferObjects\TenantData;
use Infrastructure\Persistence\Eloquent\Models\User;
use Infrastructure\Shared\DataTransferObject;

class UserData extends DataTransferObject
{
    public int $id;
    public string $name;
    public string $email;
    public DateTime $created_at;
    public ?DateTime $updated_at;
    public ?TenantData $tenant;

    public static function fromModel(User $user): self
    {
        return new self([
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'tenant' => $user->tenant ? TenantData::fromModel($user->tenant) : null,
        ] + $user->toArray());
    }

    public static function fromArray(array $data): self
    {
        return new self([
            'created_at' => date_create($data['created_at']),
            'updated_at' => $data['updated_at'] ? date_create($data['updated_at']) : null,
            'tenant' => $data['tenant'] ? TenantData::fromArray($data['tenant']) : null,
        ] + $data);
    }
}
