<?php

use Database\Factories\TenantFactory;
use Illuminate\Support\Str;

uses()->group('api');

beforeEach(function () {
    $this->uri = 'api/v1/tenants';
});

it('should show tenant', function () {
    $tenant = TenantFactory::new()->create();

    $response = $this->get("{$this->uri}/{$tenant->uuid}");

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                'token',
                'name',
                'image_url',
                'slug',
                'contact',
                'created_at',
            ],
        ]);
});

it('should return 404 status code when not found', function () {
    $tenantIdInvalid = Str::uuid();
    $response = $this->get("{$this->uri}/{$tenantIdInvalid}");

    $response->assertNotFound();
});
