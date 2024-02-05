<?php

namespace Docs\v1\Orders;

use OpenApi\Attributes as OA;

class ShowOrder
{
    #[OA\Get(
        path: '/api/v1/orders/{identify}',
        tags: ['Orders'],
        summary: 'Show order',
        security: [['api' => []]],
        parameters: [
            new OA\Parameter(ref: '#/components/parameters/identify'),
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
                            type: 'object',ref: '#/components/schemas/OrderResponse'
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 403,
                description: 'Forbidden403',
                content: new OA\JsonContent(ref: "#/components/schemas/Forbidden403")
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
