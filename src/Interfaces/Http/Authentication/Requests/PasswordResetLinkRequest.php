<?php

namespace Interfaces\Http\Authentication\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;

class PasswordResetLinkRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
        ];
    }
}
