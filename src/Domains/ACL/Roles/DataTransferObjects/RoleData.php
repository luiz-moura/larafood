<?php

namespace Domains\ACL\Roles\DataTransferObjects;

use Domains\ACL\Permissions\DataTransferObjects\PermissionCollection;
use Illuminate\Support\Arr;
use Infrastructure\Shared\DataTransferObject;

class RoleData extends DataTransferObject
{
    public int $id;
    public string $name;
    public ?string $description;
    public ?PermissionCollection $permissions;

    public static function fromArray(array $data)
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            description: Arr::get($data, 'description'),
            permissions: isset($data['permissions'])
                ? PermissionCollection::fromArray($data['permissions'])
                : null,
        );
    }
}
