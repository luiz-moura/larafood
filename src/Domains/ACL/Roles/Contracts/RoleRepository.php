<?php

namespace Domains\ACL\Roles\Contracts;

use Domains\ACL\Roles\DataTransferObjects\RoleData;
use Domains\ACL\Roles\DataTransferObjects\RolePaginatedData;
use Interfaces\Http\Roles\DataTransferObjects\IndexRoleRequestData;
use Interfaces\Http\Roles\DataTransferObjects\RoleFormData;
use Interfaces\Http\Roles\DataTransferObjects\SearchRoleRequestData;

interface RoleRepository
{
    public function create(RoleFormData $formData): bool;
    public function update(int $id, RoleFormData $formData): bool;
    public function delete(int $id): bool;
    public function findById(int $id): RoleData;
    public function getAll(IndexRoleRequestData $validatedRequest): RolePaginatedData;
    public function attachPermissions(int $id, array $permissions): bool;
    public function detachPermission(int $id, int $permissionId): bool;
    public function queryByNameAndDescription(SearchRoleRequestData $validatedRequest): RolePaginatedData;
    public function queryByUser(int $userId, IndexRoleRequestData $validatedRequest): RolePaginatedData;
    public function queryAvailableFromUser(int $userId, IndexRoleRequestData $validatedRequest): RolePaginatedData;
    public function queryAvailableFromUserByName(int $userId, SearchRoleRequestData $validatedRequest): RolePaginatedData;
}
