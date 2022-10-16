<?php

namespace Domains\Tenants\Actions;

use Domains\Tenants\Contracts\TenantRepository;
use Domains\Tenants\DataTransferObjects\TenantData;

class FindTenantAction
{
    public function __construct(private TenantRepository $tenantRepository)
    {
    }

    public function __invoke(int $id, array $with = []): TenantData
    {
        return $this->tenantRepository->find($id, $with);
    }
}
