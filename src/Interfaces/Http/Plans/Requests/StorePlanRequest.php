<?php

namespace Interfaces\Http\Plans\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class StorePlanRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255|unique:plans',
            'description' => 'nullable|min:3|max:255',
            'price' => 'required|numeric',
        ];
    }
}
