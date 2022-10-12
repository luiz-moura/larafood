<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Tables\Contracts\TableRepository as TableRepositoryContract;
use Domains\Tables\DataTransferObjects\TableData;
use Domains\Tables\DataTransferObjects\TablePaginatedData;
use Illuminate\Database\Query\Builder;
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
        return TableData::fromModel(
            $this->model->create(
                $formData->toArray() + ['tenant_id' => $tenantId]
            )
        );
    }

    public function find(int $id): TableData
    {
        return TableData::fromModel(
            $this->model->tenantUser()->findOrFail($id)
        );
    }

    public function update(int $id, TableFormData $formData): bool
    {
        return $this->model->tenantUser()->findOrFail($id)->update($formData->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->model->tenantUser()->findOrFail($id)->delete();
    }

    public function getAll(IndexTableRequestData $paginationData): TablePaginatedData
    {
        $tables = $this->model
            ->select()
            ->tenantUser()
            ->when($paginationData->order, function (Builder $query) use ($paginationData) {
                $query->orderBy($paginationData->order, $paginationData->sort);
            })
            ->latest()
            ->paginate($paginationData->per_page, $paginationData->page);

        return TablePaginatedData::fromPaginator($tables);
    }

    public function queryByDescription(SearchTableRequestData $paginationData): TablePaginatedData
    {
        $tables = $this->model
            ->select()
            ->tenantUser()
            ->where('identify', 'ilike', "%{$paginationData->filter}%")
            ->orWhere('description', 'ilike', "%{$paginationData->filter}%")
            ->when($paginationData->order, function (Builder $query) use ($paginationData) {
                $query->orderBy($paginationData->order, $paginationData->sort);
            })
            ->latest()
            ->paginate($paginationData->per_page, $paginationData->page);

        return TablePaginatedData::fromPaginator($tables);
    }
}
