<?php

namespace Domains\Tables\DataTransferObjects;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Infrastructure\Persistence\Eloquent\Models\Table;

class TableDataCollection extends Collection
{
    public static function fromModelCollection(Collection|SupportCollection $collection): self
    {
        return new self(
            $collection->map(fn (Table $item) => TableData::fromModel($item))
        );
    }
}
