<?php

namespace Docs\Authenticate\Client\Payloads;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Client body properties",
    description: "Client body properties"
)]
class AuthenticationBodyProperties
{
    #[OA\Property(
        property: 'email',
        description: 'Client email.',
        type: 'string',
        example: 'client@rgb.com.br',
    )]
    public string $email;

    #[OA\Property(
        property: 'password',
        description: 'Client password.',
        type: 'string',
        example: '12345678',
    )]
    public string $password;

    #[OA\Property(
        property: 'device_name',
        description: 'Client device.',
        type: 'string',
        example: 'Smartphone',
    )]
    public string $device_name;
}
