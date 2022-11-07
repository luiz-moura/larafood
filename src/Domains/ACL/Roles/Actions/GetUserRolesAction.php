<?php

namespace Domains\ACL\Roles\Actions;

use Domains\ACL\Roles\Contracts\RoleRepository;
use Domains\ACL\Roles\DataTransferObjects\RolePaginatedData;
use Interfaces\Http\Roles\DataTransferObjects\IndexRoleRequestData;

class GetUserRolesAction
{
    public function __construct(private RoleRepository $roleRepository)
    {
    }

    public function __invoke(int $userId, IndexRoleRequestData $validatedRequest): RolePaginatedData
    {
        return $this->roleRepository->queryByUser($userId, $validatedRequest);
    }
}
