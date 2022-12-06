<?php

namespace Domains\Products\Repositories;

use Domains\Products\DataTransferObjects\ProductData;
use Domains\Products\DataTransferObjects\ProductPaginatedData;
use Interfaces\Http\Products\DataTransferObjects\IndexProductRequestData;
use Interfaces\Http\Products\DataTransferObjects\ProductFormData;
use Interfaces\Http\Products\DataTransferObjects\SearchProductRequestData;

interface ProductRepository
{
    public function create(int $tenantId, ProductFormData $formData): ProductData;
    public function find(int $id, array $with = []): ProductData;
    public function findBySlugAndTenantUuid(string $slug, string $companyToken): ProductData;
    public function update(int $id, ProductFormData $formData): bool;
    public function delete(int $id): bool;
    public function getAll(IndexProductRequestData $paginationData, array $with = []): ProductPaginatedData;
    public function queryByName(SearchProductRequestData $paginationData, array $with = []): ProductPaginatedData;
    public function queryByTenantUuid(string $companyToken, IndexProductRequestData $paginationData): ProductPaginatedData;
    public function attachCategories(int $id, array $categories): void;
    public function detachCategory(int $productId, int $categoryId): void;
}
