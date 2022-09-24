<?php

namespace Interfaces\Http\Authentication\Requests;

use Illuminate\Validation\Rules;
use Interfaces\Http\Common\Requests\AbstractRequest;

class NewPasswordRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
