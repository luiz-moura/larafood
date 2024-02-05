<?php

namespace Docs\v1\Orders;

use OpenApi\Attributes as OA;

class StoreOrder
{
    #[OA\Post(
        path: '/api/v1/orders',
        tags: ['Orders'],
        summary: 'Create order',
        security: [['api' => []]],
        parameters: [
            new OA\Parameter(ref: '#/components/parameters/company_token'),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/OrderBody")
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'OK',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'object',
                            ref: '#/components/schemas/OrderResponse'
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
