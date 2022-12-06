<?php

namespace Domains\Tables\Contracts;

use Domains\Tables\DataTransferObjects\TableData;
use Domains\Tables\DataTransferObjects\TablePaginatedData;
use Interfaces\Http\Tables\DataTransferObjects\IndexTableRequestData;
use Interfaces\Http\Tables\DataTransferObjects\SearchTableRequestData;
use Interfaces\Http\Tables\DataTransferObjects\TableFormData;

interface TableRepository
{
    public function find(int $id): TableData;
    public function findByIdentifyAndTenantUuid(string $identify, string $companyToken): TableData;
    public function update(int $id, TableFormData $formData): bool;
    public function create(int $tenantId, TableFormData $formData): TableData;
    public function delete(int $id): bool;
    public function getAll(IndexTableRequestData $validatedRequest): TablePaginatedData;
    public function queryByDescription(SearchTableRequestData $validatedRequest): TablePaginatedData;
    public function queryByTenantUuid(string $companyToken, IndexTableRequestData $validatedRequest): TablePaginatedData;
}
