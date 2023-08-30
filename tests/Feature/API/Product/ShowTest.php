<?php

use Database\Factories\ProductFactory;
use Database\Factories\TenantFactory;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->uri = 'api/v1/products';
    $this->company = TenantFactory::new()->create();
    $this->header = [
        'company_token' => $this->company->uuid,
    ];
});

it('should return product successfully', function () {
    $product = ProductFactory::new()->create(['tenant_id' => $this->company->id]);

    $response = $this->withHeaders($this->header)
        ->get("{$this->uri}/{$product->uuid}");

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                'company_token',
                'identify',
                'flag',
                'name',
                'image',
                'price',
                'description',
            ],
        ]);
});

it('should return 404 status code when not found', function () {
    $productIdInvalid = Str::uuid();
    $response = $this->withHeaders($this->header)
        ->get("{$this->uri}/{$productIdInvalid}");

    $response->assertNotFound();
});
