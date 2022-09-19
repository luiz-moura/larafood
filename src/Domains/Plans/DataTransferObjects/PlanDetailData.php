<?php

namespace Domains\Plans\DataTransferObjects;

use Infrastructure\Persistence\Eloquent\Models\PlanDetail;
use Infrastructure\Shared\DataTransferObject;

class PlanDetailData extends DataTransferObject
{
    public int $id;
    public int $plan_id;
    public string $name;

    public static function fromModel(PlanDetail $data): self
    {
        return new self($data->toArray());
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }
}
