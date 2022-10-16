<?php

namespace Domains\Tenants\Actions;

use Domains\Tenants\Contracts\TenantRepository;
use Domains\Tenants\DataTransferObjects\TenantPaginatedData;
use Interfaces\Http\Tenant\DataTransferObjects\SearchTenantRequestData;

class SearchTenantsAction
{
    public function __construct(private TenantRepository $tenantRepository)
    {
    }

    public function __invoke(SearchTenantRequestData $validatedRequest): TenantPaginatedData
    {
        return $this->tenantRepository->queryByName($validatedRequest);
    }
}
