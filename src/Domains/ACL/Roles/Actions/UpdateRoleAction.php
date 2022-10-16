<?php

namespace Domains\ACL\Roles\Actions;

use Domains\ACL\Roles\Contracts\RoleRepository;
use Interfaces\Http\Roles\DataTransferObjects\RoleFormData;

class UpdateRoleAction
{
    public function __construct(private RoleRepository $roleRepository)
    {
    }

    public function __invoke(int $id, RoleFormData $formData): void
    {
        $this->roleRepository->update($id, $formData);
    }
}
