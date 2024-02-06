<?php

namespace Domains\Orders\DataTransferObjects;

use Illuminate\Support\Collection;

class OrderCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => OrderData::fromArray($item), $data)
        );
    }
}
