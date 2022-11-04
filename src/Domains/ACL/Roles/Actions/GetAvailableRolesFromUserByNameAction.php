<?php

namespace Domains\ACL\Roles\Actions;

use Domains\ACL\Roles\Contracts\RoleRepository;
use Interfaces\Http\Roles\DataTransferObjects\SearchRoleRequestData;

class GetAvailableRolesFromUserByNameAction
{
    public function __construct(private RoleRepository $roleRepository)
    {
    }

    public function __invoke(int $id, SearchRoleRequestData $validatedRequest)
    {
        return $this->roleRepository->queryAvailableFromUserByName($id, $validatedRequest);
    }
}
