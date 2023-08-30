<?php

namespace Domains\Products\Repositories;

use Domains\Products\DataTransferObjects\ProductCollection;
use Domains\Products\DataTransferObjects\ProductData;
use Domains\Products\DataTransferObjects\ProductPaginatedData;
use Interfaces\Http\Products\DataTransferObjects\IndexProductRequestData;
use Interfaces\Http\Products\DataTransferObjects\ProductFormData;
use Interfaces\Http\Products\DataTransferObjects\SearchProductRequestData;

interface ProductRepository
{
    public function create(int $tenantId, ProductFormData $formData): ProductData;
    public function find(int $id, array $with = []): ProductData;
    public function findByUuidAndTenantUuid(string $identify, string $companyToken): ProductData;
    public function update(int $id, ProductFormData $formData): bool;
    public function delete(int $id): bool;
    public function getAll(IndexProductRequestData $validatedRequest, array $with = []): ProductPaginatedData;
    public function queryByName(SearchProductRequestData $validatedRequest, array $with = []): ProductPaginatedData;
    public function queryByTenantUuid(string $companyToken, IndexProductRequestData $validatedRequest): ProductPaginatedData;
    public function queryThoseInTheUuidAndTenantUuid(array $ids, string $companyToken): ProductCollection;
    public function attachCategories(int $id, array $categories): void;
    public function detachCategory(int $productId, int $categoryId): void;
}
