<?php

namespace Domains\Tenants\Actions;

use Domains\Tenants\Contracts\TenantRepository;
use Domains\Tenants\DataTransferObjects\TenantPaginatedData;
use Interfaces\Http\Tenant\DataTransferObjects\IndexTenantRequestData;

class GetAllTenantsAction
{
    public function __construct(private TenantRepository $tenantRepository)
    {
    }

    public function __invoke(IndexTenantRequestData $validatedRequest): TenantPaginatedData
    {
        return $this->tenantRepository->getAll($validatedRequest);
    }
}
