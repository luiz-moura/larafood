<?php

namespace Domains\Shared\Pagination;

use Infrastructure\Shared\DataTransferObject;

class PaginatedLinkData extends DataTransferObject
{
    public ?string $url;
    public string $label;
    public bool $active;
}
