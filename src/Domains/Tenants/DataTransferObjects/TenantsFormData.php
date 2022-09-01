<?php

namespace Domains\Tenants\DataTransferObjects;

use DateTime;
use Infrastructure\Shared\DataTransferObject;

class TenantsFormData extends DataTransferObject
{
    public int $plan_id;
    public string $cnpj;
    public string $name;
    public string $email;
    public DateTime $expires_at;
}
