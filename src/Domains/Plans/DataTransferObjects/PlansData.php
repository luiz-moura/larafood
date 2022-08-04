<?php

namespace Domains\Plans\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class PlansData extends DataTransferObject
{
    public ?int $id;
    public string $name;
    public float $price;
    public string $description;
    public ?string $url;
    public ?string $created_at;
    public ?string $updated_at;

    public static function createFromArray(array $data)
    {
        return new self([
            'id' => $data['id'] ?? null,
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
            'url' => $data['url'] ?? null,
            'created_at' => $data['created_at'] ?? null,
            'updated_at' => $data['updated_at'] ?? null,
        ]);
    }
}
