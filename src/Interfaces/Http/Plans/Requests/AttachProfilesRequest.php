<?php

namespace Interfaces\Http\Plans\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachProfilesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'profiles' => 'required|array',
        ];
    }
}
