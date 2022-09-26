<?php

namespace Interfaces\Http\Categories\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class IndexCategoryRequest extends AbstractRequest
{
    use Paginable;

    public function rules(): array
    {
        return self::paginationRules();
    }
}
