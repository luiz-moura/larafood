<?php

namespace Docs\Authenticate\Client\Payloads;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Client response properties",
    description: "Client response properties"
)]
class AuthenticationResponseProperties
{
    #[OA\Property(
        property: 'email',
        description: 'Client email.',
        type: 'string',
        example: 'client@rgb.com.br',
    )]
    public string $email;

    #[OA\Property(
        property: 'token',
        description: 'Client token.',
        type: 'string',
        example: '1a648577-a56e-4ab4-8db4-e5af25122dd7',
    )]
    public string $token;
}
