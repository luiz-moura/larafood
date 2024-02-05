<?php

namespace Docs\Common\Responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Register not found",
    description: "Register not found"
)]
class NotFound404
{
    #[OA\Property(
        property: 'message',
        type: 'string',
        example: 'Register not found.',
    )]
    public string $message;
}
