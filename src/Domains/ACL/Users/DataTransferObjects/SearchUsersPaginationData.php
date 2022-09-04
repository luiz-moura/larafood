<?php

namespace Domains\ACL\Users\DataTransferObjects;

use Domains\Shared\Pagination\AbstractPaginationData;

class SearchUsersPaginationData extends AbstractPaginationData
{
    public ?string $filter;
}
