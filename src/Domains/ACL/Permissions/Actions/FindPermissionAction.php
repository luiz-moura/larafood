<?php

namespace Domains\ACL\Permissions\Actions;

use Domains\ACL\Permissions\Contracts\PermissionRepository;
use Domains\ACL\Permissions\DataTransferObjects\PermissionData;

class FindPermissionAction
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function __invoke(int $id, array $with = []): PermissionData
    {
        return $this->permissionRepository->findById($id, $with);
    }
}
