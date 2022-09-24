<?php

namespace Interfaces\Http\Users\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class IndexUserRequestData extends AbstractPaginationData
{
    public static function fromRequest(array $data): self
    {
        return new self($data);
    }
}
