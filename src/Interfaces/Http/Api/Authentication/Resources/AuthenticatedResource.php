<?php

namespace Interfaces\Http\Api\Authentication\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthenticatedResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'email' => $this->email,
            'token' => $this->token,
        ];
    }
}
