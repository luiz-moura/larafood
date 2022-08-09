<?php

namespace Domains\ACL\Permissions\Actions;

use Domains\ACL\Permissions\Contracts\PermissionRepository;
use Domains\ACL\Permissions\DataTransferObjects\PermissionsData;

class FindPermissionByIdAction
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function __invoke(int $id): PermissionsData
    {
        return $this->permissionRepository->findById($id);
    }
}
