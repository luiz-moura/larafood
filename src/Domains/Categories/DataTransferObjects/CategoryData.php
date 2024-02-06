<?php

namespace Domains\Categories\DataTransferObjects;

use Domains\Tenants\DataTransferObjects\TenantData;
use Infrastructure\Shared\DataTransferObject;

class CategoryData extends DataTransferObject
{
    public int $id;
    public string $uuid;
    public string $name;
    public string $description;
    public string $url;
    public ?TenantData $tenant;

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            uuid: $data['uuid'],
            name: $data['name'],
            description: $data['description'],
            url: $data['url'],
            tenant: isset($data['tenant']) ? TenantData::fromArray($data['tenant']) : null,
        );
    }
}
