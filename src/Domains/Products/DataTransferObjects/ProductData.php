<?php

namespace Domains\Products\DataTransferObjects;

use DateTime;
use Domains\Tenants\DataTransferObjects\TenantData;
use Infrastructure\Shared\DataTransferObject;

class ProductData extends DataTransferObject
{
    public int $id;
    public string $uuid;
    public int $tenant_id;
    public string $name;
    public string $description;
    public string $flag;
    public float $price;
    public string $image;
    public DateTime $created_at;
    public ?DateTime $updated_at;
    public ?TenantData $tenant;

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            uuid: $data['uuid'],
            tenant_id: $data['tenant_id'],
            name: $data['name'],
            description: $data['description'],
            flag: $data['flag'],
            price: $data['price'],
            image: $data['image'],
            created_at: date_create($data['created_at']),
            updated_at: $data['updated_at'] ? date_create($data['updated_at']) : null,
            plan: isset($data['tenant']) ? TenantData::fromArray($data['tenant']) : null,
        );
    }
}
