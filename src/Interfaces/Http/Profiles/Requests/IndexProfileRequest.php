<?php

namespace Interfaces\Http\Profiles\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page' => 'nullable|integer',
            'per_page' => 'nullable|integer',
            'order' => 'nullable|string',
            'sort' => ['required_with:order', Rule::in(['asc', 'desc'])],
        ];
    }
}
