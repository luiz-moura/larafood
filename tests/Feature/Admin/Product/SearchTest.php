<?php

use Database\Factories\ProductFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/products/search';
    $this->user = UserFactory::new()->create();
});

it('Should find by name', function () {
    ProductFactory::new()->create([
        'name' => 'Chair',
        'tenant_id' => $this->user->tenant->id,
    ]);
    ProductFactory::new()->create([
        'name' => 'Board',
        'tenant_id' => $this->user->tenant->id,
    ]);

    $response = $this->actingAs($this->user)->get("{$this->uri}?filter=chair");

    $response->assertOk();
    $response->assertSee('Chair');
});
