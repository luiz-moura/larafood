<?php

namespace Domains\Plans\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class PlansCollectionData extends DataTransferObject
{
    public static function createFromArray(array $plans): array
    {
        return array_map(
            fn (array $plan) => PlanData::createFromArray($plan),
            $plans
        );
    }
}
