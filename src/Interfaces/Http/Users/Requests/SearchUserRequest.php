<?php

namespace Interfaces\Http\Users\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class SearchUserRequest extends AbstractRequest
{
    use Paginable;

    public function rules(): array
    {
        return [
            ...self::paginationRules(),
            'filter' => 'nullable|min:3',
        ];
    }
}
