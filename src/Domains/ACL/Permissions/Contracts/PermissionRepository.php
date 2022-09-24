<?php

namespace Domains\ACL\Permissions\Contracts;

use Domains\ACL\Permissions\DataTransferObjects\PermissionData;
use Domains\ACL\Permissions\DataTransferObjects\PermissionPaginatedData;
use Interfaces\Http\Permissions\DataTransferObjects\IndexPermissionRequestData;
use Interfaces\Http\Permissions\DataTransferObjects\PermissionFormData;
use Interfaces\Http\Permissions\DataTransferObjects\SearchPermissionRequestData;

interface PermissionRepository
{
    public function create(PermissionFormData $formData): bool;
    public function update(int $id, PermissionFormData $formData): bool;
    public function delete(int $id): bool;
    public function findById(int $id, array $with = []): PermissionData;
    public function getAll(IndexPermissionRequestData $paginationData, array $with = []): PermissionPaginatedData;
    public function getAllByProfile(int $profileId, IndexPermissionRequestData $paginationData, array $with = []): PermissionPaginatedData;
    public function getAllAvailableByProfile(int $profileId, IndexPermissionRequestData $paginationData): PermissionPaginatedData;
    public function queryByNameAndDescription(SearchPermissionRequestData $paginationData, array $with = []): PermissionPaginatedData;
    public function queryByProfile(int $profileId, SearchPermissionRequestData $paginationData, array $with = []): PermissionPaginatedData;
    public function queryAvailableByProfile(int $profileId, SearchPermissionRequestData $paginationData, array $with = []): PermissionPaginatedData;
}
