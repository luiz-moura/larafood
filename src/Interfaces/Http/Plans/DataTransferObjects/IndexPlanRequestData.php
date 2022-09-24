<?php

namespace Interfaces\Http\Plans\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class IndexPlanRequestData extends AbstractPaginationData
{
    public static function fromRequest(array $data): self
    {
        return new self($data);
    }
}
