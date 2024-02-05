<?php

namespace Docs\Authenticate\Client;

use OpenApi\Attributes as OA;

class RegisterClient
{
    #[OA\Post(
        path: '/api/auth/register',
        tags: ['Authenticate'],
        summary: 'Client register',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/RegisterBodyProperties")
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
                            ref: '#/components/schemas/RegisterResponseProperties'
                        )
                    ]
                )
            ),
        ]
    )]
    public function __wakeup() {}
}
