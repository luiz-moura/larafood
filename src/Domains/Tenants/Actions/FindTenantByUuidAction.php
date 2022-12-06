<?php

namespace Domains\Tenants\Actions;

use Domains\Tenants\Contracts\TenantRepository;
use Domains\Tenants\DataTransferObjects\TenantData;

class FindTenantByUuidAction
{
    public function __construct(private TenantRepository $tenantRepository)
    {
    }

    public function __invoke(string $uuid): TenantData
    {
        return $this->tenantRepository->findByUuid($uuid);
    }
}
