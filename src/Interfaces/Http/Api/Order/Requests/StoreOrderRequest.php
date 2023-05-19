<?php

namespace Interfaces\Http\Api\Order\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class StoreOrderRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'table' => 'nullable|uuid|exists:tables,uuid',
            'comment' => 'nullable|max:1000',
            'products' => 'required|array',
            'products.*.identify' => 'required|uuid|exists:products,uuid',
            'products.*.quantity' => 'required|integer|min:1',
        ];
    }
}
