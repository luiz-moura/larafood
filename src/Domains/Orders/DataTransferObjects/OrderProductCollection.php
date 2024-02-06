<?php

namespace Domains\Orders\DataTransferObjects;

use Illuminate\Support\Collection;

class OrderProductCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => OrderProductData::fromArray($item), $data)
        );
    }
}
