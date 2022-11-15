<?php

namespace Interfaces\Http\Api\Authentication\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class ClientRequestData extends DataTransferObject
{
    public string $name;
    public string $email;
    public string $password;

    public static function fromRequest(array $data): self
    {
        return new self([
            ...$data,
            'password' => bcrypt($data['password']),
        ]);
    }
}
