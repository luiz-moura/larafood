<?php

namespace Domains\ACL\Profiles\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class ProfileData extends DataTransferObject
{
    public int $id;
    public string $name;
    public ?string $description;

    public static function fromArray(array $data)
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            description: $data['description'] ?? null,
        );
    }
}
