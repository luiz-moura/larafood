<?php

namespace Domains\ACL\Roles\Actions;

use Domains\ACL\Roles\Contracts\RoleRepository;

class DetachRolePermissionAction
{
    public function __construct(private RoleRepository $roleRepository)
    {
    }

    public function __invoke(int $roleId, int $permissionId): void
    {
        $this->roleRepository->detachPermission($roleId, $permissionId);
    }
}
