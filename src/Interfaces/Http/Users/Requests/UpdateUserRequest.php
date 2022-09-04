<?php

namespace Interfaces\Http\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
