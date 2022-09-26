<?php

namespace Interfaces\Http\Categories\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class SearchCategoryRequestData extends AbstractPaginationData
{
    public ?string $filter;

    public static function fromRequest(array $data): self
    {
        return new self($data);
    }
}
