<?php

namespace Docs\v1\Evaluation\Payloads;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Pagination Unprocessable Content",
    description: "Pagination Unprocessable Content"
)]
class Evaluation422Response
{
    #[OA\Property(
        property: 'message',
        type: 'string',
        example: 'The stars field is required.',
    )]
    public string $message;

    #[OA\Property(
        property: 'errors',
        type: 'object',
        properties: [
            new OA\Property(
                property: 'stars',
                type: 'array',
                nullable: true,
                items: new OA\Items(
                    example: 'The stars field is required.'
                )
            ),
        ],
    )]
    public object $errors;
}
