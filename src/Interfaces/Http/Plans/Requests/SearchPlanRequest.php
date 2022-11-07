<?php

namespace Interfaces\Http\Plans\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class SearchPlanRequest extends AbstractRequest
{
    use Paginable {
        rules as private rulesStandard;
    }

    public function rules(): array
    {
        return [
            ...self::rulesStandard(),
            'filter' => 'string|min:2',
        ];
    }
}
