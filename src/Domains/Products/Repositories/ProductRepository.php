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
    public function update(int $id, ProductFormData $formData): bool;
    public function delete(int $id): bool;
    public function getAll(IndexProductRequestData $paginationData, array $with = []): ProductPaginatedData;
    public function queryByName(SearchProductRequestData $paginationData, array $with = []): ProductPaginatedData;
}
