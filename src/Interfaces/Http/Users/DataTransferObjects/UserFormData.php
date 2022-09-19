<?php

namespace Interfaces\Http\Users\DataTransferObjects;

use Illuminate\Support\Facades\Hash;
use Infrastructure\Shared\DataTransferObject;

class UserFormData extends DataTransferObject
{
    public string $name;
    public string $email;
    public ?string $password;

    public static function fromRequest(array $data): self
    {
        return new self([
            'password' => isset($data['password'])
                ? Hash::make($data['password'])
                : null,
        ] + $data);
    }
}
