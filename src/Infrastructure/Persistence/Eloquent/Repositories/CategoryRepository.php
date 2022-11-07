<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Categories\DataTransferObjects\CategoryData;
use Domains\Categories\DataTransferObjects\CategoryPaginatedData;
use Domains\Categories\Repositories\CategoryRepository as CategoryRepositoryContract;
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
            $this->model->with($with)->findOrFail($id)
        );
    }

    public function update(int $id, CategoryFormData $formData): bool
    {
        return (bool) $this->model->findOrFail($id)->update($formData->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function getAll(IndexCategoryRequestData $paginationData, array $with = []): CategoryPaginatedData
    {
        $categories = $this->model
            ->select()
            ->with($with)
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return CategoryPaginatedData::fromPaginator($categories);
    }

    public function queryByName(SearchCategoryRequestData $paginationData, array $with = []): CategoryPaginatedData
    {
        $categories = $this->model
            ->select()
            ->with($with)
            ->where(function ($query) use ($paginationData) {
                $query->where('name', 'ilike', "%{$paginationData->filter}%")
                    ->orWhere('description', 'ilike', "%{$paginationData->filter}%");
            })
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return CategoryPaginatedData::fromPaginator($categories);
    }

    public function queryByProductId(int $id, IndexCategoryRequestData $request, array $with = []): CategoryPaginatedData
    {
        $categories = $this->model
            ->select()
            ->with($with)
            ->whereRelation('products', 'products.id', $id)
            ->orderBy($request->order, $request->sort)
            ->paginate($request->per_page, $request->page);

        return CategoryPaginatedData::fromPaginator($categories);
    }

    public function queryAvailableByProductId(int $id, IndexCategoryRequestData $request, array $with = []): CategoryPaginatedData
    {
        $categories = $this->model
            ->select()
            ->with($with)
            ->whereDoesntHave('products', fn ($query) => $query->where('products.id', $id))
            ->orderBy($request->order, $request->sort)
            ->paginate($request->per_page, $request->page);

        return CategoryPaginatedData::fromPaginator($categories);
    }

    public function queryByNameAndByProductId(int $id, SearchCategoryRequestData $request, array $with = []): CategoryPaginatedData
    {
        $categories = $this->model
            ->select()
            ->with($with)
            ->whereHas('products', fn ($query) => $query->where('products.id', $id))
            ->where(function ($query) use ($request) {
                $query->where('name', 'ilike', "%{$request->filter}%")
                    ->orWhere('description', 'ilike', "%{$request->filter}%");
            })
            ->orderBy($request->order, $request->sort)
            ->paginate($request->per_page, $request->page);

        return CategoryPaginatedData::fromPaginator($categories);
    }
}
