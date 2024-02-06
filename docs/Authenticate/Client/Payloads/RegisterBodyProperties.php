<?php

namespace Docs\Authenticate\Client\Payloads;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Client body properties",
    description: "Client body properties"
)]
class RegisterBodyProperties
{
    #[OA\Property(
        property: 'name',
        description: 'Client name.',
        type: 'string',
        example: 'The delivery man shook the soda',
    )]
    public string $name;

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
}
