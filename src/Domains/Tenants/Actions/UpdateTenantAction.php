<?php

namespace Domains\Tenants\Actions;

use Domains\Tenants\Contracts\TenantRepository;
use Interfaces\Http\Tenant\DataTransferObjects\TenantFormData;

class UpdateTenantAction
{
    public function __construct(private TenantRepository $tenantRepository)
    {
    }

    public function __invoke(int $id, TenantFormData $formData): void
    {
        $this->tenantRepository->update($id, $formData);
    }
}
