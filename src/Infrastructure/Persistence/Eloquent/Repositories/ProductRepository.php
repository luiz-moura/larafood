<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Products\DataTransferObjects\ProductData;
use Domains\Products\DataTransferObjects\ProductPaginatedData;
use Domains\Products\Repositories\ProductRepository as ProductRepositoryContract;
use Infrastructure\Persistence\Eloquent\Models\Product;
use Infrastructure\Shared\AbstractRepository;
use Interfaces\Http\Products\DataTransferObjects\IndexProductRequestData;
use Interfaces\Http\Products\DataTransferObjects\ProductFormData;
use Interfaces\Http\Products\DataTransferObjects\SearchProductRequestData;

class ProductRepository extends AbstractRepository implements ProductRepositoryContract
{
    protected $modelClass = Product::class;

    public function create(int $tenantId, ProductFormData $formData): ProductData
    {
        return ProductData::fromModel(
            $this->model->create(
                $formData->toArray() + ['tenant_id' => $tenantId]
            )
        );
    }

    public function find(int $id, array $with = []): ProductData
    {
        return ProductData::fromModel(
            $this->model->with($with)->findOrFail($id)
        );
    }

    public function findByUuidAndTenantUuid(string $identify, string $companyToken): ProductData
    {
        return ProductData::fromModel(
            $this->model->newQueryWithoutScopes()
                ->where('uuid', $identify)
                ->whereRelation('tenant', 'uuid', $companyToken)
                ->firstOrFail()
        );
    }

    public function update(int $id, ProductFormData $formData): bool
    {
        return $this->model->findOrFail($id)->update(
            $formData->toArray()
        );
    }

    public function delete(int $id): bool
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function attachCategories(int $id, array $categories): void
    {
        $this->model->findOrFail($id)->categories()->attach($categories);
    }

    public function detachCategory(int $productId, int $categoryId): void
    {
        $this->model->findOrFail($productId)->categories()->detach($categoryId);
    }

    public function getAll(IndexProductRequestData $paginationData, array $with = []): ProductPaginatedData
    {
        $products = $this->model
            ->select()
            ->with($with)
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return ProductPaginatedData::fromPaginator($products);
    }

    public function queryByName(SearchProductRequestData $paginationData, array $with = []): ProductPaginatedData
    {
        $products = $this->model
            ->select()
            ->with($with)
            ->where(function ($query) use ($paginationData) {
                $query->where('name', 'ilike', "%{$paginationData->filter}%")
                    ->orWhere('description', 'ilike', "%{$paginationData->filter}%");
            })
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return ProductPaginatedData::fromPaginator($products);
    }

    public function queryByTenantUuid(string $companyToken, IndexProductRequestData $validatedRequest): ProductPaginatedData
    {
        $products = $this->model->newQueryWithoutScopes()
            ->select()
            ->whereRelation('tenant', 'uuid', $companyToken)
            ->orderBy($validatedRequest->order, $validatedRequest->sort)
            ->paginate($validatedRequest->per_page, $validatedRequest->page);

        return ProductPaginatedData::fromPaginator($products);
    }
}
