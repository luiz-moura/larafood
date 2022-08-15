<?php

namespace Interfaces\Http\Profiles\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProfileRequest extends FormRequest
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
                Rule::unique('profiles')->ignore($id),
            ],
            'description' => 'nullable|min:3|max:255',
        ];
    }
}
