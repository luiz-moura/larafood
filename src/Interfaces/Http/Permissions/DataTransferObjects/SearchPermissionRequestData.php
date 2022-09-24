<?php

namespace Interfaces\Http\Permissions\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class SearchPermissionRequestData extends AbstractPaginationData
{
    public ?string $filter;

    public static function fromRequest(array $data): self
    {
        return new self($data);
    }
}
