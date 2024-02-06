<?php

namespace Domains\ACL\Clients\DataTransferObjects;

use DateTime;
use Infrastructure\Shared\DataTransferObject;

class ClientData extends DataTransferObject
{
    public int $id;
    public string $name;
    public string $email;
    public string $password;
    public DateTime $created_at;
    public ?DateTime $updated_at;

    public static function fromArray(array $data)
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
            created_at: date_create($data['created_at']),
            updated_at: $data['updated_at'] ? date_create($data['updated_at']) : null,
        );
    }
}
