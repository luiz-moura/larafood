<?php

namespace Domains\Shared\Pagination;

use Infrastructure\Shared\DataTransferObject;

abstract class AbstractPaginationData extends DataTransferObject
{
    public ?string $order;
    public string $sort = 'desc';
    public int $per_page = 20;
    public int $page = 1;
}