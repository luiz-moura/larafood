<?php

namespace Interfaces\Http\Api\Authentication\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class AuthenticatedTokenRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'device_name' => 'required|string|max:255',
        ];
    }
}
