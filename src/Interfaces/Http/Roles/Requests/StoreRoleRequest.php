<?php

namespace Interfaces\Http\Roles\Requests;

use Illuminate\Validation\Rule;
use Interfaces\Http\Common\Requests\AbstractRequest;

class StoreRoleRequest extends AbstractRequest
{
    public function rules(): array
    {
        $id = $this->segment(3);

        return [
            'name' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('profiles')->ignore($id),
            ],
            'description' => 'nullable|min:3|max:255',
        ];
    }
}
