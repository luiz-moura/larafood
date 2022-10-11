<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Products\DataTransferObjects\ProductData;
use Domains\Products\DataTransferObjects\ProductPaginatedData;
use Domains\Products\Repositories\ProductRepository as ProductRepositoryContract;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
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
            $this->model->with($with)->tenantUser()->findOrFail($id)
        );
    }

    public function update(int $id, ProductFormData $formData): bool
    {
        return $this->model->tenantUser()->findOrFail($id)->update(Arr::whereNotNull($formData->toArray()));
    }

    public function delete(int $id): bool
    {
        return $this->model->tenantUser()->findOrFail($id)->delete();
    }

    public function getAll(IndexProductRequestData $paginationData, array $with = []): ProductPaginatedData
    {
        $products = $this->model
            ->select()
            ->with($with)
            ->tenantUser()
            ->when($paginationData->order, function (Builder $query) use ($paginationData) {
                $query->orderBy($paginationData->order, $paginationData->sort);
            })
            ->latest()
            ->paginate($paginationData->per_page, $paginationData->page);

        return ProductPaginatedData::fromPaginator($products);
    }

    public function queryByName(SearchProductRequestData $paginationData, array $with = []): ProductPaginatedData
    {
        $products = $this->model
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

        return ProductPaginatedData::fromPaginator($products);
    }

    public function attachCategories(int $id, array $categories): void
    {
        $this->model->findOrFail($id)->categories()->attach($categories);
    }

    public function detachCategory(int $productId, int $categoryId): void
    {
        $this->model->findOrFail($productId)->categories()->detach($categoryId);
    }
}
