<?php

namespace Interfaces\Http\Users\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class AttachRolesRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'roles' => 'required|array',
        ];
    }
}
