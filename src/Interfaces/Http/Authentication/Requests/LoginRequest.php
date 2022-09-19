<?php

namespace Interfaces\Http\Authentication\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class LoginRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }
}
