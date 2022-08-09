<?php

namespace Interfaces\Http\Permissions\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->segment(3);

        return [
            'name' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('permissions')->ignore($id),
            ],
            'description' => 'nullable|min:3|max:255',
        ];
    }
}
