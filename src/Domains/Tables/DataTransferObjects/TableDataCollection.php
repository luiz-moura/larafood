<?php

namespace Domains\Tables\DataTransferObjects;

use Illuminate\Database\Eloquent\Collection;

class TableDataCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => TableData::fromArray($item), $data)
        );
    }
}
