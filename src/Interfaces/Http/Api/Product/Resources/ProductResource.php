<?php

namespace Interfaces\Http\Api\Product\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'company_token' => $this->tenant->uuid,
            'identify' => $this->uuid,
            'flag' => $this->flag,
            'name' => $this->name,
            'image' => url("storage/{$this->image}"),
            'price' => $this->price,
            'description' => $this->description,
        ];
    }
}
