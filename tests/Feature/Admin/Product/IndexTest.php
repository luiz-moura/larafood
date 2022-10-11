<?php

use Database\Factories\ProductFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/products';
    $this->user = UserFactory::new()->create();
});

it('Should return all products', function () {
    $bike = ProductFactory::new()->create([
        'name' => 'Bike',
        'tenant_id' => $this->user->tenant->id,
    ]);
    $motherboard = ProductFactory::new()->create([
        'name' => 'Motherboard',
        'tenant_id' => $this->user->tenant->id,
    ]);

    $response = $this->actingAs($this->user)->get($this->uri);

    $response->assertOk();
    $response->assertSee($bike->name);
    $response->assertSee($motherboard->name);
});
