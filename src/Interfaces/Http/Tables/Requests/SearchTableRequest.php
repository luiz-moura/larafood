<?php

namespace Interfaces\Http\Tables\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class SearchTableRequest extends AbstractRequest
{
    use Paginable;

    public function rules(): array
    {
        return [
            ...self::paginationRules(),
            'filter' => 'required|min:3',
        ];
    }
}
