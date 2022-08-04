<?php

namespace Domains\Plans\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class PlansCollection extends DataTransferObject
{
    public static function createFromArray(array $plans): self
    {
        return new self(
            array_map(
                fn (array $plan) => PlansData::createFromArray($plan),
                $plans
            )
        );
    }
}
