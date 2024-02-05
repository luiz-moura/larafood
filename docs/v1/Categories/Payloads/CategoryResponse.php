<?php

namespace Docs\v1\Categories\Payloads;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Category response properties",
    description: "Category response properties"
)]
class CategoryResponse
{
    #[OA\Property(
        property: 'identify',
        description: 'Identify of the category.',
        type: 'string',
        example: '1a648577-a56e-4ab4-8db4-e5af25122dd7',
    )]
    public string $identify;

    #[OA\Property(
        property: 'name',
        description: 'Name of the category.',
        type: 'string',
        example: 'Pizza',
    )]
    public string $name;

    #[OA\Property(
        property: 'description',
        description: 'Description of the category.',
        type: 'string',
        example: 'Any',
    )]
    public string $description;

    #[OA\Property(
        property: 'url',
        description: 'Url of the category.',
        type: 'string',
        example: 'http://url.com/category/action',
    )]
    public string $url;
}
