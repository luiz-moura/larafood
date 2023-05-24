<?php

namespace Interfaces\Http\Api\OrderEvaluation\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class StoreOrderEvaluationRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'stars' => 'required|integer|min:0|max:5',
            'comment' => 'nullable|min:3|max:1000',
        ];
    }
}
