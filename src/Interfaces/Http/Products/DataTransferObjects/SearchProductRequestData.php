<?php

namespace Interfaces\Http\Products\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class SearchProductRequestData extends AbstractPaginationData
{
    public ?string $filter;

    public static function fromRequest(array $data): self
    {
        return new self($data);
    }
}
