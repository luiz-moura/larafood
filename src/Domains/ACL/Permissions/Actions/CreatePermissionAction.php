<?php

namespace Domains\ACL\Permissions\Actions;

use Domains\ACL\Permissions\Contracts\PermissionRepository;
use Domains\ACL\Permissions\DataTransferObjects\PermissionsData;

class CreatePermissionAction
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function __invoke(PermissionsData $permissionData): bool
    {
        return $this->permissionRepository->create($permissionData);
    }
}
