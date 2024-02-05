<?php

namespace Docs\Common\Responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Unauthenticated",
    description: "Unauthenticated"
)]
class Unauthenticated401
{
    #[OA\Property(
        property: 'message',
        type: 'string',
        example: 'Unauthenticated.',
    )]
    public string $message;
}
