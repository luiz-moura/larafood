<?php

namespace Domains\Plans\DataTransferObjects;

use Domains\Shared\Pagination\AbstractPaginationData;

class SearchPlansPaginationData extends AbstractPaginationData
{
    public ?string $filter;
}
