<?php

namespace Interfaces\Http\Api\Order\DataTransferObjects;

use Illuminate\Support\Collection;

class OrderProductFormCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => OrderProductFormData::fromArray($item), $data)
        );
    }
}
