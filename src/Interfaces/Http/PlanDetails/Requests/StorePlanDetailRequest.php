<?php

namespace Interfaces\Http\PlanDetails\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class StorePlanDetailRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
        ];
    }
}
