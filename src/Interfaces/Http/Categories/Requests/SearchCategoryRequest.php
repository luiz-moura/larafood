<?php

namespace Interfaces\Http\Categories\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class SearchCategoryRequest extends AbstractRequest
{
    use Paginable {
        rules as private rulesStandard;
    }

    public function rules(): array
    {
        return [
            ...self::rulesStandard(),
            'filter' => 'nullable|min:3',
        ];
    }
}
