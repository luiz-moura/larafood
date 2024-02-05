<?php

namespace Docs\Authenticate\Client;

use OpenApi\Attributes as OA;

class LogoutClient
{
    #[OA\Get(
        path: '/api/auth/logout',
        tags: ['Authenticate'],
        summary: 'Client Logout',
        security: [['api' => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: 'OK',
            ),
        ]
    )]
    public function __wakeup() {}
}
