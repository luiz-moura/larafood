<?php

namespace Interfaces\Http\Users\Requests;

use Illuminate\Validation\Rules;
use Interfaces\Http\Common\Requests\AbstractRequest;

class UpdateUserRequest extends AbstractRequest
{
    public function rules(): array
    {
        $id = $this->segment(3);

        return [
            'name' => 'required|string|min:3|max:255',
            'email' => "required|string|email|max:255|unique:users,email,{$id},id",
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
