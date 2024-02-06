<?php

use Database\Factories\PlanFactory;
use Database\Factories\UserFactory;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->uri = 'admin/plans';
    $this->user = UserFactory::new()->create();
});

it('should delete plan', function () {
    $plan = PlanFactory::new()->create();

    $response = $this->actingAs($this->user)->delete("{$this->uri}/{$plan->url}");

    $response->assertSessionHasNoErrors();
    $response->assertStatus(Response::HTTP_FOUND);
});

it('should return status code 404 when not found', function () {
    $response = $this->actingAs($this->user)->delete("{$this->uri}/url-not-found");

    $response->assertNotFound();
});
