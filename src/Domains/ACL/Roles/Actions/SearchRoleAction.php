<?php

namespace Domains\ACL\Roles\Actions;

use Domains\ACL\Roles\Contracts\RoleRepository;
use Domains\ACL\Roles\DataTransferObjects\RolePaginatedData;
use Interfaces\Http\Roles\DataTransferObjects\SearchRoleRequestData;

class SearchRoleAction
{
    public function __construct(private RoleRepository $roleRepository)
    {
    }

    public function __invoke(SearchRoleRequestData $validatedRequest): RolePaginatedData
    {
        return $this->roleRepository->queryByNameAndDescription($validatedRequest);
    }
}
