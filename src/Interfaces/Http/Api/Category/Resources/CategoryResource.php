<?php

namespace Interfaces\Http\Api\Category\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'identify' => $this->uuid,
            'name' => $this->name,
            'url' => $this->url,
            'description' => $this->description,
        ];
    }
}
