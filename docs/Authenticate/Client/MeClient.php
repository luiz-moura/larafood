<?php

namespace Docs\Authenticate\Client;

use OpenApi\Attributes as OA;

class MeClient
{
    #[OA\Get(
        path: '/api/auth/me',
        tags: ['Authenticate'],
        summary: 'Client information',
        security: [['api' => []]],
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
            new OA\Response(
                response: 401,
                description: 'Unauthenticated401',
                content: new OA\JsonContent(ref: "#/components/schemas/Unauthenticated401")
            ),
        ]
    )]
    public function __wakeup() {}
}
