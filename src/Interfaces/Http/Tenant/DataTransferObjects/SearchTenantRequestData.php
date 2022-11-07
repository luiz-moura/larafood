<?php

namespace Interfaces\Http\Tenant\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class SearchTenantRequestData extends AbstractPaginationData
{
    public string $filter;
}
