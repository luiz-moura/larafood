<?php

use Database\Factories\ProductFactory;
use Database\Factories\TenantFactory;

beforeEach(function () {
    $this->uri = 'api/v1/products';
    $this->company = TenantFactory::new()->create();
    $this->header = [
        'company_token' => $this->company->uuid,
    ];
});

it('should return all products successfully', function () {
    ProductFactory::new()->count(5)->create(['tenant_id' => $this->company->id]);

    $response = $this->withHeaders($this->header)->get($this->uri);

    $response->assertOk()
        ->assertJsonCount(5, 'data');
});
