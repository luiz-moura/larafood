<?php

namespace Domains\Plans\DataTransferObjects;

use Illuminate\Support\Collection;

class PlanCollection extends Collection
{
    public static function fromArray(array $plans): self
    {
        return new self(
            array_map(fn (array $plan) => PlanData::fromArray($plan), $plans)
        );
    }
}
