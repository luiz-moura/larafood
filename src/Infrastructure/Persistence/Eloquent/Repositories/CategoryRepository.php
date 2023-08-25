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
                ['tenant_id' => $tenantId] + $formData->toArray()
            )
        );
    }

    public function find(int $id, array $with = []): CategoryData
    {
        return CategoryData::fromModel(
            $this->model->with($with)->findOrFail($id)
        );
    }

    public function findByUuidAndTenantUuid(string $identify, string $companyToken): CategoryData
    {
        return CategoryData::fromModel(
            $this->model->newQueryWithoutScopes()
                ->where('uuid', $identify)
                ->whereRelation('tenant', 'uuid', $companyToken)
                ->firstOrFail()
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

    public function getAll(IndexCategoryRequestData $validatedRequest, array $with = []): CategoryPaginatedData
    {
        $categories = $this->model
            ->select()
            ->with($with)
            ->orderBy($validatedRequest->order, $validatedRequest->sort)
            ->paginate($validatedRequest->per_page, $validatedRequest->page);

        return CategoryPaginatedData::fromPaginator($categories);
    }

    public function queryByName(SearchCategoryRequestData $validatedRequest, array $with = []): CategoryPaginatedData
    {
        $categories = $this->model
            ->select()
            ->with($with)
            ->where(function ($query) use ($validatedRequest) {
                $query->where('name', 'ilike', "%{$validatedRequest->filter}%")
                    ->orWhere('description', 'ilike', "%{$validatedRequest->filter}%");
            })
            ->orderBy($validatedRequest->order, $validatedRequest->sort)
            ->paginate($validatedRequest->per_page, $validatedRequest->page);

        return CategoryPaginatedData::fromPaginator($categories);
    }

    public function queryByProductId(int $id, IndexCategoryRequestData $validatedRequest, array $with = []): CategoryPaginatedData
    {
        $categories = $this->model
            ->select()
            ->with($with)
            ->whereRelation('products', 'products.id', $id)
            ->orderBy($validatedRequest->order, $validatedRequest->sort)
            ->paginate($validatedRequest->per_page, $validatedRequest->page);

        return CategoryPaginatedData::fromPaginator($categories);
    }

    public function queryAvailableByProductId(int $id, IndexCategoryRequestData $validatedRequest, array $with = []): CategoryPaginatedData
    {
        $categories = $this->model
            ->select()
            ->with($with)
            ->whereDoesntHave('products', fn ($query) => $query->where('products.id', $id))
            ->orderBy($validatedRequest->order, $validatedRequest->sort)
            ->paginate($validatedRequest->per_page, $validatedRequest->page);

        return CategoryPaginatedData::fromPaginator($categories);
    }

    public function queryByNameAndByProductId(int $id, SearchCategoryRequestData $validatedRequest, array $with = []): CategoryPaginatedData
    {
        $categories = $this->model
            ->select()
            ->with($with)
            ->whereHas('products', fn ($query) => $query->where('products.id', $id))
            ->where(function ($query) use ($validatedRequest) {
                $query->where('name', 'ilike', "%{$validatedRequest->filter}%")
                    ->orWhere('description', 'ilike', "%{$validatedRequest->filter}%");
            })
            ->orderBy($validatedRequest->order, $validatedRequest->sort)
            ->paginate($validatedRequest->per_page, $validatedRequest->page);

        return CategoryPaginatedData::fromPaginator($categories);
    }

    public function queryByTenantUuid(string $companyToken, IndexCategoryRequestData $validatedRequest): CategoryPaginatedData
    {
        $categories = $this->model->newQueryWithoutScopes()
            ->select()
            ->whereRelation('tenant', 'uuid', $companyToken)
            ->orderBy($validatedRequest->order, $validatedRequest->sort)
            ->paginate($validatedRequest->per_page, $validatedRequest->page);

        return CategoryPaginatedData::fromPaginator($categories);
    }
}
