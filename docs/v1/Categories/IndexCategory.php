<?php

namespace Docs\v1\Categories;

use OpenApi\Attributes as OA;

class IndexCategory
{
    #[OA\Get(
        path: '/api/v1/categories',
        tags: ['Categories'],
        summary: 'List of categories',
        parameters: [
            new OA\Parameter(ref: '#/components/parameters/company_token'),
            new OA\Parameter(ref: '#/components/parameters/page'),
            new OA\Parameter(ref: '#/components/parameters/per_page'),
            new OA\Parameter(ref: '#/components/parameters/sort'),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'OK',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(
                                ref: '#/components/schemas/CategoryResponse'
                            ),
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: 'MissingCompanyToken400',
                content: new OA\JsonContent(ref: "#/components/schemas/MissingCompanyToken400")
            ),
            new OA\Response(
                response: 422,
                description: 'PaginationUnprocessableContent422',
                content: new OA\JsonContent(ref: "#/components/schemas/PaginationUnprocessableContent422")
            ),
        ]
    )]
    public function __wakeup() {}
}
