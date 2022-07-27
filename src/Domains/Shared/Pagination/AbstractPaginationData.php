<?php

namespace Domains\Shared\Pagination;

use Infrastructure\Shared\DataTransferObject;

abstract class AbstractPaginationData extends DataTransferObject
{
    public ?string $order;
    public ?string $sort;
    public ?string $per_page;
    public ?string $page;
}
