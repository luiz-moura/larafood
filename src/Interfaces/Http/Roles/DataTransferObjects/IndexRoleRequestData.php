<?php

namespace Interfaces\Http\Roles\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class IndexRoleRequestData extends AbstractPaginationData
{
    public static function fromRequest(array $data): self
    {
        return new self($data);
    }
}
