<?php

namespace Domains\ACL\Users\DataTransferObjects;

use DateTime;
use Domains\Tenants\DataTransferObjects\TenantData;
use Infrastructure\Shared\DataTransferObject;

class UserData extends DataTransferObject
{
    public int $id;
    public string $name;
    public string $email;
    public DateTime $created_at;
    public ?DateTime $updated_at;
    public ?TenantData $tenant;

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            email: $data['email'],
            created_at: date_create($data['created_at']),
            updated_at: $data['updated_at'] ? date_create($data['updated_at']) : null,
            tenant: isset($data['tenant']) ? TenantData::fromArray($data['tenant']) : null,
        );
    }
}
