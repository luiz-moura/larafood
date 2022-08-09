<?php

namespace Domains\ACL\Permissions\DataTransferObjects;

use Domains\Shared\Pagination\AbstractPaginationData;

class SearchPermissionsPaginationData extends AbstractPaginationData
{
    public ?string $filter;
}
