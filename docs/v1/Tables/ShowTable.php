<?php

namespace Docs\v1\Tables;

use OpenApi\Attributes as OA;

class ShowTable
{
    #[OA\Get(
        path: '/api/v1/tables/{identify}',
        tags: ['Tables'],
        summary: 'Show table details',
        parameters: [
            new OA\Parameter(ref: '#/components/parameters/company_token'),
            new OA\Parameter(ref: '#/components/parameters/identify'),
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
                            type: 'object',
                            ref: '#/components/schemas/TableResponse'
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
                response: 404,
                description: 'NotFound404',
                content: new OA\JsonContent(ref: "#/components/schemas/NotFound404")
            ),
        ]
    )]
    public function __wakeup() {}
}
