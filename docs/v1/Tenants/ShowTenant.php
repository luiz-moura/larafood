<?php

namespace Docs\v1\Tenants;

use OpenApi\Attributes as OA;

class ShowTenant
{
    #[OA\Get(
        path: '/api/v1/tenants/{identify}',
        tags: ['Tenants'],
        summary: 'Show tenant details',
        parameters: [
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
                            ref: '#/components/schemas/TenantResponse'
                        )
                    ]
                )
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
