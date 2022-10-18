<?php

namespace Domains\ACL\Permissions\Actions;

use Domains\ACL\Permissions\Contracts\PermissionRepository;
use Domains\ACL\Permissions\DataTransferObjects\PermissionPaginatedData;
use Interfaces\Http\Permissions\DataTransferObjects\SearchPermissionRequestData;

class SearchPermissionsAvailableByRoleAction
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function __invoke(int $roleId, SearchPermissionRequestData $validatedRequest): PermissionPaginatedData
    {
        return $this->permissionRepository->queryAvailableByRoleWithFilter($roleId, $validatedRequest);
    }
}
