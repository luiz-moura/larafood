<?php

use Database\Factories\PlanDetailFactory;
use Database\Factories\PlanFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/plans';
    $this->user = UserFactory::new()->create();
    $this->plan = PlanFactory::new()->has(
        PlanDetailFactory::new(['name' => 'Test']),
        'details'
    )->create();
});

it('Should create detail for plan', function () {
    $response = $this->actingAs($this->user)->get(
        "{$this->uri}/{$this->plan->url}/details/{$this->plan->details->first()->id}",
        PlanDetailFactory::new()->mock()
    );

    $response->assertOk();
    $response->assertSee('Test');
});
