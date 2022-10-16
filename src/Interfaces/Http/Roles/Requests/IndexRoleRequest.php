<?php

namespace Interfaces\Http\Roles\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class IndexRoleRequest extends AbstractRequest
{
    use Paginable;

    public function rules(): array
    {
        return self::paginationRules();
    }
}
