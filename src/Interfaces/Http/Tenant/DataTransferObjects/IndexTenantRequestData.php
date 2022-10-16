<?php

namespace Interfaces\Http\Tenant\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class IndexTenantRequestData extends AbstractPaginationData
{
    public static function fromRequest(array $data): self
    {
        return new self($data);
    }
}
