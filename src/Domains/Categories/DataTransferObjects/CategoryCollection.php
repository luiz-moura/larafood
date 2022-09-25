<?php

namespace Domains\Categories\DataTransferObjects;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Infrastructure\Persistence\Eloquent\Models\Category;

class CategoryCollection extends Collection
{
    public static function fromModelCollection(Collection|SupportCollection $collection): self
    {
        return new self(
            $collection->map(fn (Category $item) => CategoryData::fromModel($item))
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => CategoryData::fromArray($item), $data)
        );
    }
}
