<?php

namespace Interfaces\Http\Tenant\DataTransferObjects;

use Interfaces\Http\Common\Requests\AbstractRequest;

class UpdateTenantRequest extends AbstractRequest
{
    public function rules()
    {
        $id = $this->segment(3);

        return [
            'name' => "required|min:3|max:255|unique:tenants,name,{$id},id",
            'email' => "required|min:3|max:255|unique:tenants,email,{$id},id",
            'cnpj' => 'required|string',
            'logo' => 'nullable|image',
            'active' => 'required|string',
            'subscribed_at' => 'required|date',
            'expires_at' => 'required|date',
            'subscription_id' => 'required|string',
            'subscription_active' => 'required|boolean',
            'subscription_suspended' => 'required|boolean',
        ];
    }
}
