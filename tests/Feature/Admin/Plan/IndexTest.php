<?php

use Infrastructure\Persistence\Eloquent\Models\Plan;
use Infrastructure\Persistence\Eloquent\Models\User;

beforeEach(function () {
    $this->uri = 'admin/plans';
    $this->user = User::factory()->create();
});

it('Should return all plans', function () {
    $plan1 = Plan::factory()->create();
    $plan2 = Plan::factory()->create();

    $response = $this->actingAs($this->user)->get($this->uri);

    $response->assertOk();
    $response->assertSee($plan1->name);
    $response->assertSee($plan2->name);
});
