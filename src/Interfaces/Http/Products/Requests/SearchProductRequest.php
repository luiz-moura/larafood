<?php

namespace Interfaces\Http\Products\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class SearchProductRequest extends AbstractRequest
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
