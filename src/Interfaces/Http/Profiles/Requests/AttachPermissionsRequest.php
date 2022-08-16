<?php

namespace Interfaces\Http\Profiles\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachPermissionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'permissions' => 'required|array',
        ];
    }
}
