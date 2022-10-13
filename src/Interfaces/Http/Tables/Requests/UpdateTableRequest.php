<?php

namespace Interfaces\Http\Tables\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class StoreTableRequest extends AbstractRequest
{
    public function rules()
    {
        $id = $this->segment(3);

        return [
            'identify' => "required|min:3|max:255|unique:tables,identify,{$id}",
            'description' => 'required|min:3|max:1000',
        ];
    }
}
