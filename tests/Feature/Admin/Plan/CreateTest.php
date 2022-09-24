<?php

use Infrastructure\Persistence\Eloquent\Models\User;

beforeEach(function () {
    $this->uri = 'admin/plans/create';
    $this->user = User::factory()->create();
});

it('Should render create view', function () {
    $response = $this->actingAs($this->user)->get($this->uri);

    $response->assertOk();
});
