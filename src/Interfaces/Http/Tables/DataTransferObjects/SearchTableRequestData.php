<?php

namespace Interfaces\Http\Tables\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class SearchTableRequestData extends AbstractPaginationData
{
    public string $filter;
}
