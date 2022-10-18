<?php

namespace Domains\Plans\DataTransferObjects;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Infrastructure\Persistence\Eloquent\Models\PlanDetail;

class PlanDetailCollection extends Collection
{
    public static function fromArray(array $plans): self
    {
        return new self(
            array_map(fn (array $plan) => PlanDetailData::fromArray($plan), $plans)
        );
    }

    public static function fromModel(EloquentCollection|Collection $plans): self
    {
        return new self(
            $plans->map(fn (PlanDetail $plan) => PlanDetailData::fromModel($plan))->toArray()
        );
    }
}
