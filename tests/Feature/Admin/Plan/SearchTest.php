<?php

use Infrastructure\Persistence\Eloquent\Models\Plan;
use Infrastructure\Persistence\Eloquent\Models\User;

beforeEach(function () {
    $this->uri = 'admin/plans/search';
    $this->user = User::factory()->create();
});

it('Should return only plan1', function () {
    Plan::factory()->create(['name' => 'Teste']);
    Plan::factory()->create();

    $response = $this->actingAs($this->user)->get("{$this->uri}?filter=teste");

    $response->assertOk();
    $response->assertSee('Teste');
});
