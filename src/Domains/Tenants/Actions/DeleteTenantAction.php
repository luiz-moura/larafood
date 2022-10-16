<?php

namespace Domains\Tenants\Actions;

use Domains\Tenants\Contracts\TenantRepository;

class DeleteTenantAction
{
    public function __construct(private TenantRepository $tenantRepository)
    {
    }

    public function __invoke(int $id): void
    {
        $this->tenantRepository->delete($id);
    }
}
