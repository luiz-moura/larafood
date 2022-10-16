<?php

namespace Domains\ACL\Roles\Actions;

use Domains\ACL\Roles\Contracts\RoleRepository;
use Domains\ACL\Roles\DataTransferObjects\RoleData;

class FindRoleAction
{
    public function __construct(private RoleRepository $planRepository)
    {
    }

    public function __invoke(int $id): RoleData
    {
        return $this->planRepository->findById($id);
    }
}
