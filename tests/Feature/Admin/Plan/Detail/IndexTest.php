<?php

use Database\Factories\PlanDetailFactory;
use Database\Factories\PlanFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/plans';
    $this->user = UserFactory::new()->create();
});

it('should show details plan', function () {
    $plan = PlanFactory::new()->create();
    $detail = PlanDetailFactory::new()->for($plan)->create();

    $response = $this->actingAs($this->user)->get("{$this->uri}/{$plan->url}/details");

    $response->assertOk();
    $response->assertSee($detail->name);
});
