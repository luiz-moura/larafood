<?php

namespace Domains\Evaluations\DataTransferObjects;

use DateTime;
use Domains\ACL\Clients\DataTransferObjects\ClientData;
use Domains\Orders\DataTransferObjects\OrderData;
use Infrastructure\Persistence\Eloquent\Models\OrderEvaluation;
use Infrastructure\Shared\DataTransferObject;

class EvaluationData extends DataTransferObject
{
    public int $id;
    public int $stars;
    public int $order_id;
    public int $client_id;
    public ?string $comment;
    public ?ClientData $client;
    public ?OrderData $order;
    public DateTime $created_at;
    public ?DateTime $updated_at;

    public static function fromModel(OrderEvaluation $model)
    {
        return new self([
            'client' => $model->client ? ClientData::fromModel($model->client) : null,
            'order' => $model->order ? OrderData::fromModel($model->order) : null,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ] + $model->toArray());
    }
}
