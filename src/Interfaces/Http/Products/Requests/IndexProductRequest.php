<?php

namespace Interfaces\Http\Products\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class IndexProductRequest extends AbstractRequest
{
    use Paginable;

    public function rules(): array
    {
        return self::paginationRules();
    }
}
