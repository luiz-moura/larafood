<?php

namespace Docs\Common\Responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Missing Company Token",
    description: "Missing Company Token in the header"
)]
class MissingCompanyToken400
{
    #[OA\Property(
        property: 'message',
        type: 'string',
        example: 'Company token not found in the header.',
    )]
    public string $message;
}
