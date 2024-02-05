<?php

namespace Docs\v1\Tenants\Payloads;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "Tenant response properties",
    description: "Tenant response properties"
)]
class TenantResponse
{
    #[OA\Property(
        property: 'token',
        description: 'Tenant token.',
        type: 'string',
        example: '1a648577-a56e-4ab4-8db4-e5af25122dd7',
    )]
    public string $token;

    #[OA\Property(
        property: 'name',
        description: 'Tenant name.',
        type: 'string',
        example: 'Limited intelligence',
    )]
    public string $name;

    #[OA\Property(
        property: 'image_url',
        description: 'Tenant image url.',
        type: 'string',
        example: 'http://site.com/image.png',
    )]
    public string $image_url;

    #[OA\Property(
        property: 'slug',
        description: 'Tenant slug.',
        type: 'string',
        example: 'limited-intelligence',
    )]
    public string $slug;

    #[OA\Property(
        property: 'contact',
        description: 'Tenant contact.',
        type: 'string',
        example: 'limitedintelligences@test.com.br',
    )]
    public string $contact;

    #[OA\Property(
        property: 'created_at',
        description: 'Tenant creation date.',
        type: 'string',
        example: '22\/02\/2023',
    )]
    public string $created_at;
}
