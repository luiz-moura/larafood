<?php

namespace Docs\v1\Tables\Payloads;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Table response properties",
    description: "Table response properties"
)]
class TableResponse
{
    #[OA\Property(
        property: 'identify',
        description: 'Identify of the table.',
        type: 'string',
        example: '1a648577-a56e-4ab4-8db4-e5af25122dd7',
    )]
    public string $identify;

    #[OA\Property(
        property: 'name',
        description: 'Name of the table.',
        type: 'string',
        example: 'Yellow table',
    )]
    public string $name;

    #[OA\Property(
        property: 'description',
        description: 'Description of the table.',
        type: 'string',
        example: 'Any',
    )]
    public string $description;
}
