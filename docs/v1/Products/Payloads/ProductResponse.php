<?php

namespace Docs\v1\Products\Payloads;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Product response properties",
    description: "Product response properties"
)]
class ProductResponse
{
    #[OA\Property(
        property: 'identify',
        description: 'Product identify.',
        type: 'string',
        example: '1a648577-a56e-4ab4-8db4-e5af25122dd7',
    )]
    public string $identify;

    #[OA\Property(
        property: 'flag',
        description: 'Product flag.',
        type: 'string',
        example: 'coca',
    )]
    public string $flag;

    #[OA\Property(
        property: 'name',
        description: 'Product name.',
        type: 'string',
        example: 'Coca cola zero',
    )]
    public string $name;

    #[OA\Property(
        property: 'image_url',
        description: 'Product image url.',
        type: 'string',
        example: 'http://base-url/image.png',
    )]
    public string $image_url;

    #[OA\Property(
        property: 'price',
        description: 'Price of the product.',
        type: 'number',
        example: 76.4,
    )]
    public float $price;

    #[OA\Property(
        property: 'description',
        description: 'Description of the product.',
        type: 'string',
        example: 'Zero sugar',
    )]
    public string $description;
}
