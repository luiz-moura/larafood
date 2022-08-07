<?php

namespace Interfaces\Http\Plans\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
        ];
    }
}
