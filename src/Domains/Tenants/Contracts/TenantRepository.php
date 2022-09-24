<?php

namespace Domains\Tenants\Contracts;

use DateTime;
use Domains\Tenants\DataTransferObjects\TenantData;
use Interfaces\Http\Authentication\DataTransferObjects\TenantFormData;

interface TenantRepository
{
    public function create(int $planId, TenantFormData $tenantData, DateTime $expires): TenantData;
}
