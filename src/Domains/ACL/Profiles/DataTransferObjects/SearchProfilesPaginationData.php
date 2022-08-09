<?php

namespace Domains\ACL\Profiles\DataTransferObjects;

use Domains\Shared\Pagination\AbstractPaginationData;

class SearchProfilesPaginationData extends AbstractPaginationData
{
    public ?string $filter;
}
