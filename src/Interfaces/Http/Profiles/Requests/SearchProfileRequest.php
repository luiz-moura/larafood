<?php

namespace Interfaces\Http\Profiles\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class SearchProfileRequest extends AbstractRequest
{
    use Paginable {
        rules as private rulesStandard;
    }

    public function rules(): array
    {
        return [
            ...self::rulesStandard(),
            'filter' => 'nullable|min:2|max:255',
        ];
    }
}
