<?php

use Database\Factories\PlanFactory;
use Database\Factories\ProfileFactory;
use Database\Factories\UserFactory;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->uri = 'admin/plans';
    $this->user = UserFactory::new()->create();
});

it('should detach profile in plan', function () {
    $plan = PlanFactory::new()->create();
    $profile = ProfileFactory::new()->create();

    $response = $this->actingAs($this->user)->delete("{$this->uri}/{$plan->url}/profiles/{$profile->id}");

    $response->assertSessionHasNoErrors();
    $response->assertStatus(Response::HTTP_FOUND);
});
