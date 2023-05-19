<?php

namespace Domains\Orders\DataTransferObjects;

use Illuminate\Support\Collection;
use Infrastructure\Persistence\Eloquent\Models\Order;

class OrderCollection extends Collection
{
    public static function fromModelCollection(Collection $collection): self
    {
        return new self(
            $collection->map(fn (Order $item) => OrderData::fromModel($item))
        );
    }
}
