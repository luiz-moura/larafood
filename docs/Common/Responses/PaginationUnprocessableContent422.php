<?php

namespace Docs\Common\Responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Pagination Unprocessable Content",
    description: "Pagination Unprocessable Content"
)]
class PaginationUnprocessableContent422
{
    #[OA\Property(
        property: 'message',
        type: 'string',
        example: 'The page must be an integer. (and 2 more errors).',
    )]
    public string $message;

    #[OA\Property(
        property: 'errors',
        type: 'object',
        properties: [
            new OA\Property(
                property: 'page',
                type: 'array',
                nullable: true,
                items: new OA\Items(
                    example: 'The page must be an integer.'
                )
            ),
            new OA\Property(
                property: 'per_page',
                type: 'array',
                nullable: true,
                items: new OA\Items(
                    example: 'The per page must be an integer.'
                )
            ),
            new OA\Property(
                property: 'sort',
                type: 'array',
                nullable: true,
                items: new OA\Items(
                    example: 'The selected sort is invalid.'
                )
            ),
        ],
    )]
    public object $errors;
}
