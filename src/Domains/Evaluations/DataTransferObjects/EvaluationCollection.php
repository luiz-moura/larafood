<?php

namespace Domains\Evaluations\DataTransferObjects;

use Illuminate\Database\Eloquent\Collection;

class EvaluationCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn (array $item) => EvaluationData::fromArray($item), $data)
        );
    }
}
