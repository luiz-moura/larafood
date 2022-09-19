<?php

namespace Domains\ACL\Permissions\Actions;

use Domains\ACL\Permissions\Contracts\PermissionRepository;
use Domains\ACL\Permissions\DataTransferObjects\PermissionPaginatedData;
use Interfaces\Http\Permissions\DataTransferObjects\IndexPermissionRequestData;

class GetAllPermissionsAvailableByProfileAction
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function __invoke(int $profileId, IndexPermissionRequestData $paginationData, array $with = []): PermissionPaginatedData
    {
        return $this->permissionRepository->getAllAvailableByProfile($profileId, $paginationData, $with);
    }
}
