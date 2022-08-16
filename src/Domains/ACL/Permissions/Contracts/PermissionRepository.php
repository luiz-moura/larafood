<?php

namespace Domains\ACL\Permissions\Contracts;

use Domains\ACL\Permissions\DataTransferObjects\IndexPermissionsPaginationData;
use Domains\ACL\Permissions\DataTransferObjects\PermissionsData;
use Domains\ACL\Permissions\DataTransferObjects\PermissionsPaginatedData;
use Domains\ACL\Permissions\DataTransferObjects\SearchPermissionsPaginationData;

interface PermissionRepository
{
    public function create(PermissionsData $PermissionsData): bool;
    public function update(int $id, PermissionsData $PermissionsData): bool;
    public function delete(int $id): bool;
    public function findById(int $id, array $with = []): PermissionsData;
    public function searchByNameAndDescription(SearchPermissionsPaginationData $filter, array $with = []): PermissionsPaginatedData;
    public function queryAllWithFilter(IndexPermissionsPaginationData $indexPermissionsPaginationData, array $with = []): PermissionsPaginatedData;
    public function getAllForProfile(int $profileId, IndexPermissionsPaginationData $indexPermissionsPaginationData, array $with = []): PermissionsPaginatedData;
    public function searchForProfile(int $profileId, SearchPermissionsPaginationData $searchPermissionsPaginationData, array $with = []): PermissionsPaginatedData;
    public function searchAvailableForProfile(int $profileId, SearchPermissionsPaginationData $searchPermissionsPaginationData, array $with = []): PermissionsPaginatedData;
    public function getAllAvailableForProfile(int $profileId, IndexPermissionsPaginationData $permissionsPaginationData): PermissionsPaginatedData;
}
