<?php

namespace Interfaces\Http\Api\OrderEvaluation\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Interfaces\Http\Api\Authentication\Resources\ClientResource;
use Interfaces\Http\Api\Order\Resources\OrderResource;

class OrderEvaluationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'stars' => $this->stars,
            'comment' => $this->comment,
            'client' => ClientResource::make($this->client),
            'order' => OrderResource::make($this->order),
        ];
    }
}
