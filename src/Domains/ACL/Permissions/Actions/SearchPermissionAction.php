<?php

namespace Domains\ACL\Permissions\Actions;

use Domains\ACL\Permissions\Contracts\PermissionRepository;
use Domains\ACL\Permissions\DataTransferObjects\SearchPermissionsPaginationData;

class SearchPermissionAction
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function __invoke(SearchPermissionsPaginationData $searchPermissionsPaginationData, array $with = [])
    {
        return $this->permissionRepository->searchByNameAndDescription($searchPermissionsPaginationData, $with);
    }
}
