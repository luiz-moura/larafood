<?php

namespace Interfaces\Http\Users\Requests;

use Illuminate\Validation\Rules;
use Interfaces\Http\Common\Requests\AbstractRequest;

class StoreUserRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
