<?php

namespace Domains\Plans\DataTransferObjects;

use Illuminate\Support\Collection;

class PlanDetailsCollection extends Collection
{
    public static function createFromArray(array $plans): self
    {
        return new self(array_map(
            fn (array $plan) => new PlanDetailsData($plan),
            $plans
        ));
    }
}
