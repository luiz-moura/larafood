<?php

namespace Domains\ACL\Permissions\Actions;

use Domains\ACL\Permissions\Contracts\PermissionRepository;
use Interfaces\Http\Permissions\DataTransferObjects\PermissionFormData;

class UpdatePermissionAction
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function __invoke(int $id, PermissionFormData $formData): void
    {
        $this->permissionRepository->update($id, $formData);
    }
}
