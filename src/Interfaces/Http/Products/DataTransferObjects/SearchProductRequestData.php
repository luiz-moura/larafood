<?php

namespace Interfaces\Http\Products\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class SearchProductRequestData extends AbstractPaginationData
{
    public ?string $filter;
}
