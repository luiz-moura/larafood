<?php

namespace Domains\Tenants\Actions;

use Domains\Tenants\Contracts\TenantRepository;
use Domains\Tenants\DataTransferObjects\TenantsFormData;
use Domains\Tenants\DataTransferObjects\TenantsModelData;

class CreateTenantAction
{
    public function __construct(private TenantRepository $tenantRepository)
    {
    }

    public function __invoke(TenantsFormData $tenantData): TenantsModelData
    {
        return $this->tenantRepository->create($tenantData);
    }
}
