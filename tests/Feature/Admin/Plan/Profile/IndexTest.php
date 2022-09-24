<?php

use Database\Factories\PlanFactory;
use Database\Factories\ProfileFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/plans';
    $this->user = UserFactory::new()->create();
});

it('Should show profiles of plan', function () {
    $profile = ProfileFactory::new(['name' => 'Test']);
    $plan = PlanFactory::new()->has($profile)->create();

    $response = $this->actingAs($this->user)->get("{$this->uri}/{$plan->url}/profiles");

    $response->assertOk();
    $response->assertSee('Test');
});
