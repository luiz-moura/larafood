<?php

namespace Interfaces\Http\Api\Category\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
            'description' => $this->description,
        ];
    }
}
