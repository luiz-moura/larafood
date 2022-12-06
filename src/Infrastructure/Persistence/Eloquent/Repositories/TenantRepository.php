<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use DateTime;
use Domains\Tenants\Contracts\TenantRepository as TenantRepositoryContract;
use Domains\Tenants\DataTransferObjects\TenantData;
use Domains\Tenants\DataTransferObjects\TenantPaginatedData;
use Illuminate\Support\Arr;
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
        TenantFormData|UserTenantFormData $formData,
        DateTime $expires
    ): TenantData {
        return TenantData::fromModel(
            $this->model->create(
                $formData->toArray() + ['plan_id' => $planId]
            )
        );
    }

    public function find(int $id, array $with = []): TenantData
    {
        return TenantData::fromModel(
            $this->model->with($with)->findOrFail($id)
        );
    }

    public function findByUuid(string $uuid): TenantData
    {
        return TenantData::fromModel(
            $this->model->where('uuid', $uuid)->firstOrFail()
        );
    }

    public function update(int $id, TenantFormData $formData): bool
    {
        return $this->model->findOrFail($id)->update(
            Arr::whereNotNull($formData->toArray())
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
