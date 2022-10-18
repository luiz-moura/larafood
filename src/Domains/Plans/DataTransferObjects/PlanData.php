<?php

namespace Domains\Plans\DataTransferObjects;

use Infrastructure\Persistence\Eloquent\Models\Plan;
use Infrastructure\Shared\DataTransferObject;

class PlanData extends DataTransferObject
{
    public int $id;
    public string $name;
    public float $price;
    public ?string $description;
    public string $url;
    public string $created_at;
    public ?string $updated_at;
    public ?PlanDetailCollection $details;

    public static function fromModel(Plan $model)
    {
        return new self([
            'plan' => $model->plan
                ? PlanDetailCollection::fromModel($model->plan)
                : null,
            'details' => $model->details
                ? PlanDetailCollection::fromModel($model->details)
                : null,
        ] + $model->toArray());
    }

    public static function fromArray(array $data)
    {
        return new self([
            'plan' => isset($data['plan'])
                ? self::fromArray($data['plan'])
                : null,
            'details' => isset($data['details'])
                ? PlanDetailCollection::fromArray($data['details'])
                : null,
        ] + $data);
    }
}
