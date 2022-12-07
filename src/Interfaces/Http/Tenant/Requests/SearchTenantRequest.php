<?php

namespace Interfaces\Http\Tenant\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class SearchTenantRequest extends AbstractRequest
{
    use Paginable {
        rules as private rulesStandard;
    }

    public function rules()
    {
        return [
            ...self::rulesStandard(),
            'filter' => 'required|min:2|max:255',
        ];
    }
}
