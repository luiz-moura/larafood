<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Tenants\Contracts\TenantRepository as TenantRepositoryContract;
use Domains\Tenants\DataTransferObjects\TenantData;
use Domains\Tenants\DataTransferObjects\TenantPaginatedData;
use Infrastructure\Persistence\Eloquent\Models\Tenant;
use Infrastructure\Shared\AbstractRepository;
use Interfaces\Http\Authentication\DataTransferObjects\UserTenantFormData;
use Interfaces\Http\Tenant\DataTransferObjects\IndexTenantRequestData;
use Interfaces\Http\Tenant\DataTransferObjects\SearchTenantRequestData;
use Interfaces\Http\Tenant\DataTransferObjects\TenantFormData;

class TenantRepository extends AbstractRepository implements TenantRepositoryContract
{
    protected $modelClass = Tenant::class;

    public function create(
        int $planId,
        TenantFormData|UserTenantFormData $formData
    ): TenantData {
        return TenantData::fromArray(
            $this->model->create(
                $formData->toArray() + ['plan_id' => $planId]
            )->fresh()->toArray()
        );
    }

    public function find(int $id, array $with = []): TenantData
    {
        return TenantData::fromArray(
            $this->model->with($with)->findOrFail($id)->toArray()
        );
    }

    public function findByUuid(string $uuid): TenantData
    {
        return TenantData::fromArray(
            $this->model->where('uuid', $uuid)->firstOrFail()->toArray()
        );
    }

    public function update(int $id, TenantFormData $formData): bool
    {
        return $this->model->findOrFail($id)->update(
            $formData->toArray()
        );
    }

    public function delete(int $id): bool
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function getAll(IndexTenantRequestData $validatedRequest): TenantPaginatedData
    {
        $tenants = $this->model
            ->select()
            ->orderBy($validatedRequest->order, $validatedRequest->sort)
            ->paginate($validatedRequest->per_page, $validatedRequest->page);

        return TenantPaginatedData::fromPaginator($tenants);
    }

    public function queryByName(SearchTenantRequestData $validatedRequest): TenantPaginatedData
    {
        $tenants = $this->model
            ->select()
            ->where('name', 'ilike', "%{$validatedRequest->filter}%")
            ->orderBy($validatedRequest->order, $validatedRequest->sort)
            ->paginate($validatedRequest->per_page, $validatedRequest->page);

        return TenantPaginatedData::fromPaginator($tenants);
    }
}
