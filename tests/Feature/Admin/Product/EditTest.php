<?php

use Database\Factories\ProductFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/products';
    $this->user = UserFactory::new()->create();
});

it('should edit product', function () {
    $product = ProductFactory::new()->create([
        'tenant_id' => $this->user->tenant->id,
    ]);

    $response = $this->actingAs($this->user)->get("{$this->uri}/{$product->id}/edit");

    $response->assertOk();
    $response->assertSee($product->name);
    $response->assertSee($product->description);
    $response->assertSee($product->price);
});

it('should return 404 status code when not found', function () {
    $response = $this->actingAs($this->user)->get("{$this->uri}/999999/edit");

    $response->assertNotFound();
});
