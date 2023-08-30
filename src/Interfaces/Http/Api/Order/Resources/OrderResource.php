<?php

namespace Interfaces\Http\Api\Order\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Interfaces\Http\Api\Authentication\Resources\ClientResource;
use Interfaces\Http\Api\Product\Resources\ProductResource;
use Interfaces\Http\Api\Table\Resources\TableResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'identify' => $this->identify,
            'total' => $this->total,
            'status' => $this->status,
            'client' => $this->client ? ClientResource::make($this->client) : null,
            'table' => $this->table ? TableResource::make($this->table) : null,
            'products' => $this->products ? ProductResource::collection($this->products) : null,
        ];
    }
}
