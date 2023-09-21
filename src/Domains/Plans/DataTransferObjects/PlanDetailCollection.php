<?php

namespace Domains\Plans\DataTransferObjects;

use Illuminate\Support\Collection;

class PlanDetailCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => PlanDetailData::fromArray($item), $data)
        );
    }
}
