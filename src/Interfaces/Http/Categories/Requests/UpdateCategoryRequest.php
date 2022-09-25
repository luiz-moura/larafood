<?php

namespace Interfaces\Http\Categories\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class UpdateCategoryRequest extends AbstractRequest
{
    public function rules(): array
    {
        $id = $this->segment(3);

        return [
            'name' => "required|string|min:3|max:255|unique:categories,name,{$id},id",
            'description' => 'nullable|string|min:3|max:99999',
        ];
    }
}
