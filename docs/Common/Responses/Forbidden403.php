<?php

namespace Docs\Common\Responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Forbidden",
    description: "Forbidden"
)]
class Forbidden403
{
    #[OA\Property(
        property: 'message',
        type: 'string',
        example: 'O pedido não pertence a você.',
    )]
    public string $message;
}
