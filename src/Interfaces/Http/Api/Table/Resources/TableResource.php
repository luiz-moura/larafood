<?php

namespace Interfaces\Http\Api\Table\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TableResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'identify' => $this->identify,
            'description' => $this->description,
        ];
    }
}
