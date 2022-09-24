<?php

namespace Interfaces\Http\Users\DataTransferObjects;

use Interfaces\Http\Common\DataTransferObjects\AbstractPaginationData;

class SearchUserRequestData extends AbstractPaginationData
{
    public ?string $filter;

    public static function fromRequest(array $data): self
    {
        return new self($data);
    }
}
