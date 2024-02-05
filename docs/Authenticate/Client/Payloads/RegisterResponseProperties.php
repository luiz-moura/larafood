<?php

namespace Docs\Authenticate\Client\Payloads;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Order response properties",
    description: "Order response properties"
)]
class RegisterResponseProperties
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
}
