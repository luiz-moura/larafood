<?php

namespace Domains\ACL\Permissions\Actions;

use Domains\ACL\Permissions\Contracts\PermissionRepository;
use Interfaces\Http\Permissions\DataTransferObjects\SearchPermissionRequestData;

class SearchPermissionAction
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function __invoke(SearchPermissionRequestData $paginationData, array $with = [])
    {
        return $this->permissionRepository->queryByNameAndDescription($paginationData, $with);
    }
}
