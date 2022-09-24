<?php

namespace Interfaces\Http\Plans\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class SearchPlanRequest extends AbstractRequest
{
    use Paginable;

    public function rules(): array
    {
        return [
            ...self::paginationRules(),
            'filter' => 'string|min:2',
        ];
    }
}
