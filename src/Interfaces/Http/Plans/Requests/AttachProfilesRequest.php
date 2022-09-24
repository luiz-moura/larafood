<?php

namespace Interfaces\Http\Plans\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class AttachProfilesRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'profiles' => 'required|array',
        ];
    }
}
