<?php

namespace Interfaces\Http\Api\Product\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'tenant_id' => $this->tenant_id,
            'identify' => $this->uuid,
            'flag' => $this->flag,
            'name' => $this->name,
            'image' => url("storage/{$this->image}"),
            'price' => $this->price,
            'description' => $this->description,
        ];
    }
}
