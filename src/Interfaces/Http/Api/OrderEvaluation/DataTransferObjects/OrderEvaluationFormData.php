<?php

namespace Interfaces\Http\Api\OrderEvaluation\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class OrderEvaluationFormData extends DataTransferObject
{
    public ?string $comment;
    public int $stars;

    public static function fromArray(array $data): self
    {
        return new self([
            'comment' => $data['comment'] ?? null,
            'stars' => $data['stars'],
        ]);
    }
}
