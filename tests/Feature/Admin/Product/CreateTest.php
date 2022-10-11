<?php

use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/products/create';
    $this->user = UserFactory::new()->create();
});

it('Should render create view', function () {
    $response = $this->actingAs($this->user)->get($this->uri);

    $response->assertOk();
});
