<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Tables\Contracts\TableRepository as TableRepositoryContract;
use Domains\Tables\DataTransferObjects\TableData;
use Domains\Tables\DataTransferObjects\TablePaginatedData;
use Infrastructure\Persistence\Eloquent\Models\Table;
use Infrastructure\Shared\AbstractRepository;
use Interfaces\Http\Tables\DataTransferObjects\IndexTableRequestData;
use Interfaces\Http\Tables\DataTransferObjects\SearchTableRequestData;
use Interfaces\Http\Tables\DataTransferObjects\TableFormData;

class TableRepository extends AbstractRepository implements TableRepositoryContract
{
    protected $modelClass = Table::class;

    public function create(int $tenantId, TableFormData $formData): TableData
    {
        return TableData::fromArray(
            $this->model->create(
                $formData->toArray() + ['tenant_id' => $tenantId]
            )->fresh()->toArray()
        );
    }

    public function find(int $id): TableData
    {
        return TableData::fromArray(
            $this->model->findOrFail($id)->toArray()
        );
    }

    public function findByUuidAndTenantUuid(string $identify, string $companyToken): TableData
    {
        return TableData::fromArray(
            $this->model->newQueryWithoutScopes()
                ->where('uuid', $identify)
                ->whereRelation('tenant', 'uuid', $companyToken)
                ->firstOrFail()
                ->toArray()
        );
    }

    public function update(int $id, TableFormData $formData): bool
    {
        return $this->model->findOrFail($id)->update($formData->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function getAll(IndexTableRequestData $paginationData): TablePaginatedData
    {
        $tables = $this->model
            ->select()
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return TablePaginatedData::fromPaginator($tables);
    }

    public function queryByDescription(SearchTableRequestData $paginationData): TablePaginatedData
    {
        $tables = $this->model
            ->select()
            ->where(function ($query) use ($paginationData) {
                $query->where('identify', 'ilike', "%{$paginationData->filter}%")
                    ->orWhere('description', 'ilike', "%{$paginationData->filter}%");
            })
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return TablePaginatedData::fromPaginator($tables);
    }

    public function queryByTenantUuid(string $companyToken, IndexTableRequestData $validatedRequest): TablePaginatedData
    {
        $tenants = $this->model->newQueryWithoutScopes()
            ->select()
            ->whereRelation('tenant', 'uuid', $companyToken)
            ->orderBy($validatedRequest->order, $validatedRequest->sort)
            ->paginate($validatedRequest->per_page, $validatedRequest->page);

        return TablePaginatedData::fromPaginator($tenants);
    }
}
