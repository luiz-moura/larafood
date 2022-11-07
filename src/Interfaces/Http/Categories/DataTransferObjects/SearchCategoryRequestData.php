<?php

namespace Interfaces\Http\Categories\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class SearchCategoryRequestData extends AbstractPaginationData
{
    public ?string $filter;
}
