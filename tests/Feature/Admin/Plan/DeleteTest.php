<?php

use Illuminate\Http\Response;
use Infrastructure\Persistence\Eloquent\Models\Plan;
use Infrastructure\Persistence\Eloquent\Models\User;

beforeEach(function () {
    $this->uri = 'admin/plans';
    $this->user = User::factory()->create();
    $this->plan = Plan::factory()->create();
});

it('Should delete plan', function () {
    $response = $this->actingAs($this->user)->delete("{$this->uri}/{$this->plan->url}");
    $response->assertStatus(Response::HTTP_FOUND);
});

it('Should return status code 404 when not found', function () {
    $response = $this->actingAs($this->user)->delete("{$this->uri}/url-not-found");
    $response->assertNotFound();
});
