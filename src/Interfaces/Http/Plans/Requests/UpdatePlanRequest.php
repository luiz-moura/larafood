<?php

namespace Interfaces\Http\Plans\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class UpdatePlanRequest extends AbstractRequest
{
    public function rules(): array
    {
        $url = $this->segment(3);

        return [
            'name' => "required|min:3|max:255|unique:plans,name,{$url},url",
            'description' => 'required|min:3|max:255',
            'price' => 'required|numeric',
        ];
    }
}
