<?php

namespace Domains\Categories\Contracts;

use Domains\Categories\DataTransferObjects\CategoryData;
use Domains\Categories\DataTransferObjects\CategoryPaginatedData;
use Interfaces\Http\Categories\DataTransferObjects\CategoryFormData;
use Interfaces\Http\Categories\DataTransferObjects\IndexCategoryRequestData;
use Interfaces\Http\Categories\DataTransferObjects\SearchCategoryRequestData;

interface CategoryRepository
{
    public function create(int $tenantId, CategoryFormData $formData): CategoryData;
    public function find(int $id, array $with = []): CategoryData;
    public function findByUuidAndTenantUuid(string $identify, string $companyToken): CategoryData;
    public function update(int $id, CategoryFormData $formData): bool;
    public function delete(int $id): bool;
    public function getAll(IndexCategoryRequestData $validatedRequest, array $with = []): CategoryPaginatedData;
    public function queryByName(SearchCategoryRequestData $validatedRequest, array $with = []): CategoryPaginatedData;
    public function queryByProductId(int $id, IndexCategoryRequestData $validatedRequest, array $with = []): CategoryPaginatedData;
    public function queryAvailableByProductId(int $id, IndexCategoryRequestData $validatedRequest, array $with = []): CategoryPaginatedData;
    public function queryByNameAndByProductId(int $id, SearchCategoryRequestData $validatedRequest, array $with = []): CategoryPaginatedData;
    public function queryByTenantUuid(string $companyToken, IndexCategoryRequestData $validatedRequest): CategoryPaginatedData;
}
