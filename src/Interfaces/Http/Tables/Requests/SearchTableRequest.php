<?php

namespace Interfaces\Http\Tables\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class SearchTableRequest extends AbstractRequest
{
    use Paginable {
        rules as private rulesStandard;
    }

    public function rules(): array
    {
        return [
            ...self::rulesStandard(),
            'filter' => 'required|min:2|max:255',
        ];
    }
}
