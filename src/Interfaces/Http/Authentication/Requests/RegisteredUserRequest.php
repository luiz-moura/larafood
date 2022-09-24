<?php

namespace Interfaces\Http\Authentication\Requests;

use Illuminate\Validation\Rules;
use Interfaces\Http\Common\Requests\AbstractRequest;

class RegisteredUserRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'cnpj' => 'required|min:14|max:14|unique:tenants',
            'company' => 'required|min:3|max:255|unique:tenants,name',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
