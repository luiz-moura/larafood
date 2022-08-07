<?php

namespace Interfaces\Http\Plans\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255|unique:plans',
            'description' => 'nullable|min:3|max:255',
            'price' => 'required|numeric',
        ];
    }
}
