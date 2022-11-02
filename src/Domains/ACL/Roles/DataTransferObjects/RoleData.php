<?php

namespace Domains\ACL\Roles\DataTransferObjects;

use Domains\ACL\Permissions\DataTransferObjects\PermissionCollection;
use Illuminate\Support\Arr;
use Infrastructure\Persistence\Eloquent\Models\Role;
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

    public static function fromModel(Role $model)
    {
        return new self(
            id: $model->id,
            name: $model->nome,
            description: $model->description,
            permissions: $model->permissions
                ? PermissionCollection::fromModel($model->permissions)
                : null,
        );
    }
}
