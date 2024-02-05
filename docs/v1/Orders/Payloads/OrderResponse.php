<?php

namespace Docs\v1\Orders\Payloads;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Order response properties",
    description: "Order response properties"
)]
class OrderResponse
{
    #[OA\Property(
        property: 'identify',
        description: 'Order identify.',
        type: 'string',
        example: 'KTbV4hTLLe',
    )]
    public string $identify;

    #[OA\Property(
        property: 'total',
        description: 'Order total.',
        type: 'number',
        example: 56.21,
    )]
    public float $total;

    #[OA\Property(
        property: 'status',
        description: 'Order status.',
        type: 'string',
        example: 'open',
    )]
    public string $status;

    #[OA\Property(
        property: 'products',
        description: 'Order products.',
        type: 'array',
        items: new OA\Items(
            ref: '#/components/schemas/ProductResponse'
        )
    )]
    public string $products;

    #[OA\Property(
        property: 'table',
        description: 'Order table.',
        type: 'object',
        nullable: true,
        ref: '#/components/schemas/TableResponse'
    )]
    public string $table;

    #[OA\Property(
        property: 'client',
        description: 'Order client.',
        type: 'object',
        nullable: true,
        ref: '#/components/schemas/ClientResponse',
    )]
    public string $client;
}
