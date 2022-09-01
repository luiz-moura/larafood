<?php

namespace Domains\Tenants\Contracts;

use Domains\Tenants\DataTransferObjects\TenantsFormData;
use Domains\Tenants\DataTransferObjects\TenantsModelData;

interface TenantRepository
{
    public function create(TenantsFormData $tenantData): TenantsModelData;
}
