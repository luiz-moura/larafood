<?php

use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/plans/create';
    $this->user = UserFactory::new()->create();
});

it('should render create view', function () {
    $response = $this->actingAs($this->user)->get($this->uri);

    $response->assertOk();
});
