<?php

namespace Interfaces\Http\Permissions\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class SearchPermissionRequestData extends AbstractPaginationData
{
    public ?string $filter;
}
