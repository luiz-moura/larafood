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
    public function queryAllWithFilterPaginated(IndexPermissionsPaginationData $indexPermissionsPaginationData, array $with = []): PermissionsPaginatedData;
    public function getAllByProfileIdPaginated(int $profileId, IndexPermissionsPaginationData $indexPermissionsPaginationData, array $with = []): PermissionsPaginatedData;
    public function permissionsAvailableForProfile(int $profileId, IndexPermissionsPaginationData $permissionsPaginationData): PermissionsPaginatedData;
}
