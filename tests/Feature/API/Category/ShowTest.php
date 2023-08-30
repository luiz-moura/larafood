<?php

use Database\Factories\CategoryFactory;
use Database\Factories\TenantFactory;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->uri = 'api/v1/categories';
    $this->company = TenantFactory::new()->create();
    $this->header = [
        'company_token' => $this->company->uuid,
    ];
});

it('should return category successfully', function () {
    $category = CategoryFactory::new()->create(['tenant_id' => $this->company->id]);

    $response = $this->withHeaders($this->header)
        ->get("{$this->uri}/{$category->uuid}");

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                'identify',
                'name',
                'url',
                'description',
            ],
        ]);
});

it('should return 404 status code when not found', function () {
    $categoryIdInvalid = Str::uuid();
    $response = $this->withHeaders($this->header)
        ->get("{$this->uri}/{$categoryIdInvalid}");

    $response->assertNotFound();
});
