<?php

namespace Interfaces\Http\Categories\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class StoreCategoryRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255|unique:categories',
            'description' => 'required|string|min:3|max:99999',
        ];
    }
}
