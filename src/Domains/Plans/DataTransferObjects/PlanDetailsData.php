<?php

namespace Domains\Plans\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class PlanDetailsData extends DataTransferObject
{
    public ?int $id;
    public int $plan_id;
    public string $name;
}
