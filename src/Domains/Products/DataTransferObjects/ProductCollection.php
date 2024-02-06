<?php

namespace Domains\Products\DataTransferObjects;

use Illuminate\Database\Eloquent\Collection;

class ProductCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => ProductData::fromArray($item), $data)
        );
    }
}
