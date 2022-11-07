<?php

namespace Interfaces\Http\Roles\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class SearchRoleRequestData extends AbstractPaginationData
{
    public ?string $filter;
}
