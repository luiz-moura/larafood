<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Tenants\Contracts\TenantRepository as TenantRepositoryContract;
use Domains\Tenants\DataTransferObjects\TenantsFormData;
use Domains\Tenants\DataTransferObjects\TenantsModelData;
use Infrastructure\Persistence\Eloquent\Models\Tenant;
use Infrastructure\Shared\AbstractRepository;

class TenantRepository extends AbstractRepository implements TenantRepositoryContract
{
    protected $modelClass = Tenant::class;

    public function create(TenantsFormData $tenantFormData): TenantsModelData
    {
        return TenantsModelData::createFromModel(
            $this->model->create($tenantFormData->toArray())
        );
    }
}
