<?php

namespace Interfaces\Http\Plans\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class SearchPlanRequestData extends AbstractPaginationData
{
    public ?string $filter;
}
