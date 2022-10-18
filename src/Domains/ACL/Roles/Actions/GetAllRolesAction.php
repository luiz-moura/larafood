<?php

namespace Domains\ACL\Roles\Actions;

use Domains\ACL\Roles\Contracts\RoleRepository;
use Domains\ACL\Roles\DataTransferObjects\RolePaginatedData;
use Interfaces\Http\Roles\DataTransferObjects\IndexRoleRequestData;

class GetAllRolesAction
{
    public function __construct(private RoleRepository $roleRepository)
    {
    }

    public function __invoke(IndexRoleRequestData $validatedRequest): RolePaginatedData
    {
        return $this->roleRepository->getAll($validatedRequest);
    }
}
