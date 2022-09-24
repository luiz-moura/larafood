<?php

namespace Interfaces\Http\Common\Traits;

use Illuminate\Validation\Rule;

trait Paginable
{
    public function paginationRules(): array
    {
        return [
            'page' => 'nullable|integer',
            'per_page' => 'nullable|integer',
            'order' => 'nullable|string',
            'sort' => ['required_with:order', Rule::in(['asc', 'desc'])],
        ];
    }
}
