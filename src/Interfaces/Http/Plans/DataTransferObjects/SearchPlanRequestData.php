<?php

namespace Interfaces\Http\Plans\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class SearchPlanRequestData extends AbstractPaginationData
{
    public ?string $filter;

    public static function fromRequest(array $data): self
    {
        return new self($data);
    }
}
