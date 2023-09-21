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
    public ?PlanDetailCollection $details;

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            price: $data['price'],
            description: $data['description'] ?? null,
            url: $data['url'],
            plan: isset($data['details']) ? PlanDetailCollection::fromArray($data['details']) : null,
        );
    }
}
