<?php

namespace Domains\ACL\Permissions\Actions;

use Domains\ACL\Permissions\Contracts\PermissionRepository;
use Domains\ACL\Permissions\DataTransferObjects\IndexPermissionsPaginationData;
use Domains\ACL\Permissions\DataTransferObjects\PermissionsPaginatedData;

class GetAllPermissionsPaginatedAction
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function __invoke(IndexPermissionsPaginationData $indexPermissionsPaginationData): PermissionsPaginatedData
    {
        return $this->permissionRepository->queryAllWithFilterPaginated($indexPermissionsPaginationData);
    }
}
