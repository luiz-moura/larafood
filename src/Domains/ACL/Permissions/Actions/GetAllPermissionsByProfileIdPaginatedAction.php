<?php

namespace Domains\ACL\Permissions\Actions;

use Domains\ACL\Permissions\Contracts\PermissionRepository;
use Domains\ACL\Permissions\DataTransferObjects\IndexPermissionsPaginationData;
use Domains\ACL\Permissions\DataTransferObjects\PermissionsPaginatedData;

class GetAllPermissionsByProfileIdPaginatedAction
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function __invoke(int $profileId, IndexPermissionsPaginationData $indexPermissionsPaginationData, array $with): PermissionsPaginatedData
    {
        return $this->permissionRepository->getAllByProfileIdPaginated($profileId, $indexPermissionsPaginationData, $with);
    }
}
