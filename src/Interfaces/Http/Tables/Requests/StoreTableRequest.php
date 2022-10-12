<?php

namespace Interfaces\Http\Tables\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class StoreTableRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'identify' => 'required|min:3|max:255|unique:tables',
            'description' => 'nullable|min:3|max:1000',
        ];
    }
}
