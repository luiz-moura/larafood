<?php

namespace Domains\ACL\Roles\Actions;

use Domains\ACL\Roles\Contracts\RoleRepository;

class AttachPermissionsInRoleAction
{
    public function __construct(private RoleRepository $roleRepository)
    {
    }

    public function __invoke(int $roleId, array $permissions): void
    {
        $this->roleRepository->attachPermissions($roleId, $permissions);
    }
}
