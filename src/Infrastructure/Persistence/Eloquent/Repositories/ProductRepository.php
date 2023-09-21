<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Products\DataTransferObjects\ProductCollection;
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
        return ProductData::fromArray(
            $this->model->create(
                $formData->toArray() + ['tenant_id' => $tenantId]
            )->fresh()->toArray()
        );
    }

    public function find(int $id, array $with = []): ProductData
    {
        return ProductData::fromArray(
            $this->model->with($with)->findOrFail($id)->toArray()
        );
    }

    public function findByUuidAndTenantUuid(string $identify, string $companyToken): ProductData
    {
        return ProductData::fromArray(
            $this->model->newQueryWithoutScopes()
                ->where('uuid', $identify)
                ->whereRelation('tenant', 'uuid', $companyToken)
                ->firstOrFail()
                ->toArray()
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

    public function getAll(IndexProductRequestData $validatedRequest, array $with = []): ProductPaginatedData
    {
        $products = $this->model
            ->select()
            ->with($with)
            ->orderBy($validatedRequest->order, $validatedRequest->sort)
            ->paginate($validatedRequest->per_page, $validatedRequest->page);

        return ProductPaginatedData::fromPaginator($products);
    }

    public function queryByName(SearchProductRequestData $validatedRequest, array $with = []): ProductPaginatedData
    {
        $products = $this->model
            ->select()
            ->with($with)
            ->where(function ($query) use ($validatedRequest) {
                $query->where('name', 'ilike', "%{$validatedRequest->filter}%")
                    ->orWhere('description', 'ilike', "%{$validatedRequest->filter}%");
            })
            ->orderBy($validatedRequest->order, $validatedRequest->sort)
            ->paginate($validatedRequest->per_page, $validatedRequest->page);

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

    public function queryThoseInTheUuidAndTenantUuid(array $uuid, string $companyToken): ProductCollection
    {
        $products = $this->model->newQueryWithoutScopes()
            ->select()
            ->whereIn('uuid', $uuid)
            ->whereRelation('tenant', 'uuid', $companyToken)
            ->get()
            ->toArray();

        return ProductCollection::fromArray($products);
    }
}
