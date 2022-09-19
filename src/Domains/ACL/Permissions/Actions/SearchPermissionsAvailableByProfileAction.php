<?php

namespace Domains\ACL\Permissions\Actions;

use Domains\ACL\Permissions\Contracts\PermissionRepository;
use Domains\ACL\Permissions\DataTransferObjects\PermissionPaginatedData;
use Interfaces\Http\Permissions\DataTransferObjects\SearchPermissionRequestData;

class SearchPermissionsAvailableByProfileAction
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function __invoke(int $profileId, SearchPermissionRequestData $paginationData, array $with = []): PermissionPaginatedData
    {
        return $this->permissionRepository->queryAvailableByProfile($profileId, $paginationData, $with);
    }
}
