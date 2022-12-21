<?php

namespace Interfaces\Http\Api\Tenant\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'image' => $this->logo ? url("storage/{$this->logo}") : null,
            'flag' => $this->url,
            'contact' => $this->email,
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y'),
        ];
    }
}