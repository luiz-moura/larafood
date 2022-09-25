<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Categories\DataTransferObjects\CategoryData;
use Domains\Categories\DataTransferObjects\CategoryPaginatedData;
use Domains\Categories\Repositories\CategoryRepository as CategoryRepositoryContract;
use Illuminate\Database\Query\Builder;
use Infrastructure\Persistence\Eloquent\Models\Category;
use Infrastructure\Shared\AbstractRepository;
use Interfaces\Http\Categories\DataTransferObjects\CategoryFormData;
use Interfaces\Http\Categories\DataTransferObjects\IndexCategoryRequestData;
use Interfaces\Http\Categories\DataTransferObjects\SearchCategoryRequestData;

class CategoryRepository extends AbstractRepository implements CategoryRepositoryContract
{
    protected $modelClass = Category::class;

    public function create(int $tenantId, CategoryFormData $formData): CategoryData
    {
        return CategoryData::fromModel(
            $this->model->create(
                $formData->toArray() + ['tenant_id' => $tenantId]
            )
        );
    }

    public function find(int $id, array $with = []): CategoryData
    {
        return CategoryData::fromModel(
            $this->model->with($with)->tenantUser()->findOrFail($id)
        );
    }

    public function update(int $id, CategoryFormData $formData): bool
    {
        return $this->model->tenantUser()->findOrFail($id)->update($formData->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->model->tenantUser()->findOrFail($id)->delete();
    }

    public function getAll(IndexCategoryRequestData $paginationData, array $with = []): CategoryPaginatedData
    {
        $categories = $this->model
            ->select()
            ->with($with)
            ->tenantUser()
            ->when($paginationData->order, function (Builder $query) use ($paginationData) {
                $query->orderBy($paginationData->order, $paginationData->sort);
            })
            ->latest()
            ->paginate($paginationData->per_page, $paginationData->page);

        return CategoryPaginatedData::fromPaginator($categories);
    }

    public function queryByName(SearchCategoryRequestData $paginationData, array $with = []): CategoryPaginatedData
    {
        $categories = $this->model
            ->select()
            ->with($with)
            ->tenantUser()
            ->where('name', 'ilike', "%{$paginationData->filter}%")
            ->orWhere('description', 'ilike', "%{$paginationData->filter}%")
            ->when($paginationData->order, function (Builder $query) use ($paginationData) {
                $query->orderBy($paginationData->order, $paginationData->sort);
            })
            ->latest()
            ->paginate($paginationData->per_page, $paginationData->page);

        return CategoryPaginatedData::fromPaginator($categories);
    }
}
