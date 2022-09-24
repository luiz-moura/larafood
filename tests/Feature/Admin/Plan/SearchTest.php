<?php

use Database\Factories\PlanFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/plans/search';
    $this->user = UserFactory::new()->create();
});

it('Should return only plan1', function () {
    PlanFactory::new()->create(['name' => 'Teste']);
    PlanFactory::new()->create();

    $response = $this->actingAs($this->user)->get("{$this->uri}?filter=teste");

    $response->assertOk();
    $response->assertSee('Teste');
});
