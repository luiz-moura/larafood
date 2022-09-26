<?php

namespace Domains\Products\DataTransferObjects;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Infrastructure\Persistence\Eloquent\Models\Product;

class ProductCollection extends Collection
{
    public static function fromModelCollection(Collection|SupportCollection $collection): self
    {
        return new self(
            $collection->map(fn (Product $item) => ProductData::fromModel($item))
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => ProductData::fromArray($item), $data)
        );
    }
}
