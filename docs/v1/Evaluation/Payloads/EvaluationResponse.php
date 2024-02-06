<?php

namespace Docs\v1\Evaluation\Payloads;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Evaluation response properties",
    description: "Evaluation response properties"
)]
class EvaluationResponse
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
        example: 'Limited intelligence',
    )]
    public string $comment;

    #[OA\Property(
        property: 'client',
        description: 'Order client.',
        type: 'object',
        ref: '#/components/schemas/ClientResponse'
    )]
    public object $client;
}
