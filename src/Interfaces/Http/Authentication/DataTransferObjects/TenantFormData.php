<?php

namespace Interfaces\Http\Authentication\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class TenantFormData extends DataTransferObject
{
    public string $cnpj;
    public string $name;
    public string $email;

    public static function fromRequest(array $data): self
    {
        return new self($data);
    }
}
