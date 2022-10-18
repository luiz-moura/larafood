<?php

namespace Interfaces\Http\Roles\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class AttachPermissionsRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'permissions' => 'required|array',
        ];
    }
}
