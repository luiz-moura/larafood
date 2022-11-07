<?php

namespace Interfaces\Http\Authentication\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class UserTenantFormData extends DataTransferObject
{
    public string $cnpj;
    public string $name;
    public string $email;

    public static function fromRequest(array $data): self
    {
        return new self($data);
    }
}
