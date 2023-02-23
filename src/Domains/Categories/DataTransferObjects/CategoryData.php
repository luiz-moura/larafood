<?php

namespace Domains\Categories\DataTransferObjects;

use DateTime;
use Domains\Tenants\DataTransferObjects\TenantData;
use Infrastructure\Persistence\Eloquent\Models\Category;
use Infrastructure\Shared\DataTransferObject;

class CategoryData extends DataTransferObject
{
    public int $id;
    public string $uuid;
    public string $name;
    public string $description;
    public string $url;
    public DateTime $created_at;
    public ?DateTime $updated_at;
    public ?TenantData $tenant;

    public static function fromModel(Category $model): self
    {
        return new self([
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
            'tenant' => $model->tenant ? TenantData::fromModel($model->tenant) : null,
        ] + $model->toArray());
    }

    public static function fromArray(array $data): self
    {
        return new self([
            'created_at' => date_create($data['created_at']),
            'updated_at' => $data['updated_at'] ? date_create($data['updated_at']) : null,
            'tenant' => $data['tenant'] ? TenantData::fromArray($data['tenant']) : null,
        ] + $data);
    }
}
