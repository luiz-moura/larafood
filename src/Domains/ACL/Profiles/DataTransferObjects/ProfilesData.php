<?php

namespace Domains\ACL\Profiles\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class ProfilesData extends DataTransferObject
{
    public ?int $id;
    public string $name;
    public string $description;

    public static function createFromArray(array $data)
    {
        return new self([
            'id' => $data['id'] ?? null,
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
    }
}
