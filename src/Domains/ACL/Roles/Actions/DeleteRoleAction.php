<?php

namespace Domains\ACL\Roles\Actions;

use Domains\ACL\Roles\Contracts\RoleRepository;

class DeleteRoleAction
{
    public function __construct(private RoleRepository $roleRepository)
    {
    }

    public function __invoke(int $id): void
    {
        $this->roleRepository->delete($id);
    }
}
