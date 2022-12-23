<?php

namespace Interfaces\Http\Authentication\DataTransferObjects;

use DateTime;
use Infrastructure\Shared\DataTransferObject;

class UserTenantFormData extends DataTransferObject
{
    public string $cnpj;
    public string $name;
    public string $email;
    public DateTime $expires;
}
