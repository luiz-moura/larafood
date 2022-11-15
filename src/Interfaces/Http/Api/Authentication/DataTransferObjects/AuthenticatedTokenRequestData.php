<?php

namespace Interfaces\Http\Api\Authentication\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class AuthenticatedTokenRequestData extends DataTransferObject
{
    public string $email;
    public string $password;
    public string $deviceName;

    public static function fromRequest(array $data): self
    {
        return new static([
            ...$data,
            'deviceName' => $data['device_name'],
        ]);
    }
}
