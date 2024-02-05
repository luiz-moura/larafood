<?php

namespace Docs\Authenticate\Client;

use OpenApi\Attributes as OA;

class AuthenticateClient
{
    #[OA\Post(
        path: '/api/auth/authenticate',
        tags: ['Authenticate'],
        summary: 'Client authenticate',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/AuthenticationBodyProperties")
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
                            ref: '#/components/schemas/AuthenticationResponseProperties'
                        )
                    ]
                )
            ),
        ]
    )]
    public function __wakeup() {}
}
