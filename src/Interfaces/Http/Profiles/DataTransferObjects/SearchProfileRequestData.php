<?php

namespace Interfaces\Http\Profiles\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class SearchProfileRequestData extends AbstractPaginationData
{
    public ?string $filter;
}
