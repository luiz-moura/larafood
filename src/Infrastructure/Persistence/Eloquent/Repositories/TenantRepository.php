<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use DateTime;
use Domains\Tenants\Contracts\TenantRepository as TenantRepositoryContract;
use Domains\Tenants\DataTransferObjects\TenantData;
use Infrastructure\Persistence\Eloquent\Models\Tenant;
use Infrastructure\Shared\AbstractRepository;
use Interfaces\Http\Authentication\DataTransferObjects\TenantFormData;

class TenantRepository extends AbstractRepository implements TenantRepositoryContract
{
    protected $modelClass = Tenant::class;

    public function create(int $planId, TenantFormData $formData, DateTime $expires): TenantData
    {
        return TenantData::fromModel(
            $this->model->create($formData->toArray() + ['plan_id' => $planId])
        );
    }
}
