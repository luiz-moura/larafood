<?php

namespace Interfaces\Http\Api\Authentication\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class StoreClientRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:clients',
            'password' => 'required|min:6|max:20',
        ];
    }
}
