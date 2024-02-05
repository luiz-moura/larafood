<?php

namespace Docs\v1\Orders\Payloads;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Client body properties",
    description: "Client body properties"
)]
class OrderBody
{
    #[OA\Property(
        property: 'comment',
        description: 'Order comment.',
        type: 'string',
        nullable: true,
        example: 'The delivery man shook the soda',
    )]
    public string $comment;

    #[OA\Property(
        property: 'table',
        description: 'Order table.',
        type: 'string',
        nullable: true,
        example: '1a648577-a56e-4ab4-8db4-e5af25122dd7',
    )]
    public string $table;

    #[OA\Property(
        property: 'products',
        description: 'Order products.',
        type: 'array',
        items: new OA\Items(
            properties: [
                new OA\Property(
                    property: 'identify',
                    description: 'Product identify.',
                    type: 'string',
                    example: '1a648577-a56e-4ab4-8db4-e5af25122dd7'
                ),
                new OA\Property(
                    property: 'quantity',
                    description: 'Product quantity.',
                    type: 'integer',
                    example: 3
                ),
            ]
        )
    )]
    public object $products;
}
