<?php

namespace Docs\v1\Orders\Payloads;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Client response properties",
    description: "Client response properties"
)]
class ClientResponse
{
    #[OA\Property(
        property: 'name',
        description: 'Client name.',
        type: 'string',
        example: 'Aurelio',
    )]
    public string $stars;

    #[OA\Property(
        property: 'email',
        description: 'Client email.',
        type: 'string',
        example: 'aurelio@google.com',
    )]
    public string $name;
}
