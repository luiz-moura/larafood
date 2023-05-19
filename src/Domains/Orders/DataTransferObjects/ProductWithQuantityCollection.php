<?php

namespace Domains\Orders\DataTransferObjects;

use Illuminate\Support\Collection;

class ProductWithQuantityCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => ProductWithQuantityData::fromArray($item), $data)
        );
    }
}
