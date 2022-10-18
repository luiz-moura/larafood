<?php

namespace Domains\ACL\Permissions\Actions;

use Domains\ACL\Permissions\Contracts\PermissionRepository;
use Domains\ACL\Permissions\DataTransferObjects\PermissionPaginatedData;
use Interfaces\Http\Permissions\DataTransferObjects\IndexPermissionRequestData;

class GetAllPermissionsByRoleAction
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function __invoke(int $roleId, IndexPermissionRequestData $validatedRequest): PermissionPaginatedData
    {
        return $this->permissionRepository->queryByRole($roleId, $validatedRequest);
    }
}
