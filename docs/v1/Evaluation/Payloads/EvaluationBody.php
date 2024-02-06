<?php

namespace Docs\v1\Evaluation\Payloads;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Client body properties",
    description: "Client body properties"
)]
class EvaluationBody
{
    #[OA\Property(
        property: 'stars',
        description: 'Order stars.',
        type: 'integer',
        example: 4,
    )]
    public string $stars;

    #[OA\Property(
        property: 'comment',
        description: 'Order evaluation comment.',
        type: 'string',
        example: 'The delivery man shook the soda',
        nullable: true
    )]
    public string $comment;
}
