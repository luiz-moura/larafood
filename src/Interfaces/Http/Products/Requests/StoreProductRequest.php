<?php

namespace Interfaces\Http\Products\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class StoreProductRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|min:3|max:99999',
            'price' => 'required|numeric',
            'file' => 'required|image',
        ];
    }
}
