<?php

namespace Domains\Evaluations\DataTransferObjects;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Infrastructure\Persistence\Eloquent\Models\OrderEvaluation;

class EvaluationCollection extends Collection
{
    public static function fromModelCollection(Collection|SupportCollection $collection): self
    {
        return new self(
            $collection->map(fn (OrderEvaluation $item) => EvaluationData::fromModel($item))
        );
    }
}
