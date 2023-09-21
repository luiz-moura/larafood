<?php

namespace Domains\Plans\DataTransferObjects;

use Illuminate\Support\Collection;

class PlanCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => PlanData::fromArray($item), $data)
        );
    }
}
