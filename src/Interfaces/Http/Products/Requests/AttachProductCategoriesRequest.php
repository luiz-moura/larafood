<?php

namespace Interfaces\Http\Products\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class AttachProductCategoriesRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'categories' => 'required|array',
            'categories.*' => 'required|integer',
        ];
    }
}
