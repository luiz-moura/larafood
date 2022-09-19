<?php

namespace Domains\ACL\Permissions\Actions;

use Domains\ACL\Permissions\Contracts\PermissionRepository;
use Interfaces\Http\Permissions\DataTransferObjects\PermissionFormData;

class CreatePermissionAction
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function __invoke(PermissionFormData $formData): void
    {
        $this->permissionRepository->create($formData);
    }
}
