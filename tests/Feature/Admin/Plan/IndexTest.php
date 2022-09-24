<?php

use Database\Factories\PlanFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/plans';
    $this->user = UserFactory::new()->create();
});

it('Should return all plans', function () {
    $plan1 = PlanFactory::new()->create();
    $plan2 = PlanFactory::new()->create();

    $response = $this->actingAs($this->user)->get($this->uri);

    $response->assertOk();
    $response->assertSee($plan1->name);
    $response->assertSee($plan2->name);
});
