<?php

namespace Domains\Plans\DataTransferObjects;

use Illuminate\Support\Collection;

class PlansCollection extends Collection
{
    public static function createFromArray(array $plans): self
    {
        return new self(array_map(
            fn (array $plan) => PlansData::createFromArray($plan),
            $plans
        ));
    }
}
