<?php

namespace Domains\Plans\DataTransferObjects;

use Illuminate\Support\Collection;

class PlanDetailCollection extends Collection
{
    public static function fromArray(array $plans): self
    {
        return new self(
            array_map(fn (array $plan) => PlanDetailData::fromArray($plan), $plans)
        );
    }
}
