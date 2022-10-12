<?php

namespace Domains\Tables\DataTransferObjects;

use DateTime;
use Infrastructure\Persistence\Eloquent\Models\Table;
use Infrastructure\Shared\DataTransferObject;

class TableData extends DataTransferObject
{
    public int $id;
    public int $tenant_id;
    public string $identify;
    public ?string $description;
    public DateTime $created_at;
    public ?DateTime $updated_at;

    public static function fromModel(Table $model): self
    {
        return new self([
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ] + $model->toArray());
    }
}
