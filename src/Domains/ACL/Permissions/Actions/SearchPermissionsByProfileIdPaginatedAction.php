<?php

namespace Domains\ACL\Permissions\Actions;

use Domains\ACL\Permissions\Contracts\PermissionRepository;
use Domains\ACL\Permissions\DataTransferObjects\PermissionsPaginatedData;
use Domains\ACL\Permissions\DataTransferObjects\SearchPermissionsPaginationData;

class SearchPermissionsByProfileIdPaginatedAction
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function __invoke(int $profileId, SearchPermissionsPaginationData $searchPermissionsPaginationData, array $with = []): PermissionsPaginatedData
    {
        return $this->permissionRepository->searchForProfile($profileId, $searchPermissionsPaginationData, $with);
    }
}
