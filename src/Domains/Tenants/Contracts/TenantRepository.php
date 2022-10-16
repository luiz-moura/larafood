<?php

namespace Domains\Tenants\Contracts;

use DateTime;
use Domains\Tenants\DataTransferObjects\TenantData;
use Domains\Tenants\DataTransferObjects\TenantPaginatedData;
use Interfaces\Http\Tenant\DataTransferObjects\IndexTenantRequestData;
use Interfaces\Http\Tenant\DataTransferObjects\SearchTenantRequestData;
use Interfaces\Http\Tenant\DataTransferObjects\TenantFormData;

interface TenantRepository
{
    public function create(int $planId, TenantFormData $tenantData, DateTime $expires): TenantData;
    public function find(int $id, array $with = []): TenantData;
    public function update(int $id, TenantFormData $formData): bool;
    public function delete(int $id): bool;
    public function getAll(IndexTenantRequestData $validatedRequest): TenantPaginatedData;
    public function queryByName(SearchTenantRequestData $validatedRequest): TenantPaginatedData;
}
