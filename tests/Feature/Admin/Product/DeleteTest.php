<?php

use Database\Factories\ProductFactory;
use Database\Factories\UserFactory;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->uri = 'admin/products';
    $this->user = UserFactory::new()->create();
});

it('Should delete product', function () {
    $product = ProductFactory::new([
        'tenant_id' => $this->user->tenant_id,
    ])->create();

    $response = $this->actingAs($this->user)->delete("{$this->uri}/{$product->id}");

    $response->assertSessionHasNoErrors();
    $response->assertStatus(Response::HTTP_FOUND);
});

it('Should return status code 404 when not found', function () {
    $response = $this->actingAs($this->user)->delete("{$this->uri}/9999999");

    $response->assertNotFound();
});
