<?php

namespace Domains\Plans\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class PlanData extends DataTransferObject
{
    public int $id;
    public string $name;
    public float $price;
    public ?string $description;
    public string $url;
    public string $created_at;
    public ?string $updated_at;
    public ?PlanDetailCollection $details;

    public static function fromArray(array $data)
    {
        return new self([
            'details' => isset($data['details'])
                ? PlanDetailCollection::fromArray($data['details'])
                : null,
        ] + $data);
    }
}
