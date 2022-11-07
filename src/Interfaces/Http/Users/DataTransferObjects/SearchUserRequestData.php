<?php

namespace Interfaces\Http\Users\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class SearchUserRequestData extends AbstractPaginationData
{
    public ?string $filter;
}
