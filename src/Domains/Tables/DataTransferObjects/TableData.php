<?php

namespace Domains\Tables\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class TableData extends DataTransferObject
{
    public int $id;
    public string $uuid;
    public int $tenant_id;
    public string $identify;
    public ?string $description;

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            uuid: $data['uuid'],
            tenant_id: $data['tenant_id'],
            identify: $data['identify'],
            description: $data['description'] ?? null,
        );
    }
}
