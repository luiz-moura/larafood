<?php

namespace Interfaces\Http\Tenant\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class SearchTenantRequestData extends AbstractPaginationData
{
    public string $filter;

    public static function fromRequest(array $data): self
    {
        return new self($data);
    }
}
