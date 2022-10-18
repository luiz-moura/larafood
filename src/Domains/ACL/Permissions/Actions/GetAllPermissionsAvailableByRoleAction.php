<?php

namespace Domains\ACL\Permissions\Actions;

use Domains\ACL\Permissions\Contracts\PermissionRepository;
use Domains\ACL\Permissions\DataTransferObjects\PermissionPaginatedData;
use Interfaces\Http\Permissions\DataTransferObjects\IndexPermissionRequestData;

class GetAllPermissionsAvailableByRoleAction
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function __invoke(int $roleId, IndexPermissionRequestData $paginationData, array $with = []): PermissionPaginatedData
    {
        return $this->permissionRepository->queryAvailableByRole($roleId, $paginationData, $with);
    }
}
