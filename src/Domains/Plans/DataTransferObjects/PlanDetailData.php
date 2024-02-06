<?php

namespace Domains\Plans\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class PlanDetailData extends DataTransferObject
{
    public int $id;
    public int $plan_id;
    public string $name;
    public ?PlanData $plan;

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            plan_id: $data['plan_id'],
            name: $data['name'],
            plan: isset($data['plan']) ? PlanData::fromArray($data['plan']) : null,
        );
    }
}
