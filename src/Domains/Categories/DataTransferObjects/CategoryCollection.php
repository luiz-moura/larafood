<?php

namespace Domains\Categories\DataTransferObjects;

use Illuminate\Database\Eloquent\Collection;

class CategoryCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => CategoryData::fromArray($item), $data)
        );
    }
}
