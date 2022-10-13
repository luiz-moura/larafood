<?php

namespace Interfaces\Http\Tables\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class IndexTableRequestData extends AbstractPaginationData
{
    public static function fromRequest(array $data): self
    {
        return new self($data);
    }
}
