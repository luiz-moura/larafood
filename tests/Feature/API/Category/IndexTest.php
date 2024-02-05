<?php

use Database\Factories\CategoryFactory;
use Database\Factories\TenantFactory;

uses()->group('api');

beforeEach(function () {
    $this->uri = 'api/v1/categories';
    $this->company = TenantFactory::new()->create();
    $this->header = [
        'company_token' => $this->company->uuid,
    ];
});

it('should return all categories successfully', function () {
    CategoryFactory::new()->count(5)->create(['tenant_id' => $this->company->id]);

    $response = $this->withHeaders($this->header)->get($this->uri);

    $response->assertOk()
        ->assertJsonCount(5, 'data');
});
