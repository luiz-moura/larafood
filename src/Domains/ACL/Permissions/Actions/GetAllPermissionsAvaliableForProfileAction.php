<?php

namespace Domains\ACL\Permissions\Actions;

use Domains\ACL\Permissions\Contracts\PermissionRepository;
use Domains\ACL\Permissions\DataTransferObjects\IndexPermissionsPaginationData;
use Domains\ACL\Permissions\DataTransferObjects\PermissionsPaginatedData;

class GetAllPermissionsAvaliableForProfileAction
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function __invoke(int $profileId, IndexPermissionsPaginationData $indexPermissionsPaginationData, array $with = []): PermissionsPaginatedData
    {
        return $this->permissionRepository->getAllAvailableForProfile($profileId, $indexPermissionsPaginationData, $with);
    }
}
