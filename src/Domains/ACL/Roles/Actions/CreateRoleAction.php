<?php

namespace Domains\ACL\Roles\Actions;

use Domains\ACL\Roles\Contracts\RoleRepository;
use Interfaces\Http\Roles\DataTransferObjects\RoleFormData;

class CreateRoleAction
{
    public function __construct(private RoleRepository $roleRepository)
    {
    }

    public function __invoke(RoleFormData $formData): void
    {
        $this->roleRepository->create($formData);
    }
}
