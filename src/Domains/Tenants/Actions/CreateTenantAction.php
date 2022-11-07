<?php

namespace Domains\Tenants\Actions;

use DateTime;
use Domains\Tenants\Contracts\TenantRepository;
use Domains\Tenants\DataTransferObjects\TenantData;
use Interfaces\Http\Authentication\DataTransferObjects\UserTenantFormData;
use Interfaces\Http\Tenant\DataTransferObjects\TenantFormData;

class CreateTenantAction
{
    public function __construct(private TenantRepository $tenantRepository)
    {
    }

    public function __invoke(
        int $planId,
        TenantFormData|UserTenantFormData $formData,
        DateTime $expires
    ): TenantData {
        return $this->tenantRepository->create($planId, $formData, $expires);
    }
}
