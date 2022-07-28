<?php

namespace Domains\Plans\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class PlanData extends DataTransferObject
{
    public string $name;
    public string $url;
    public float $price;
    public string $description;
    public ?string $created_at;
    public ?string $updated_at;

    public static function createFromArray(array $data)
    {
        return new self([
            'name' => $data['name'],
            'url' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
        ]);
    }
}
