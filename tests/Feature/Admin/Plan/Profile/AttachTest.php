<?php

use Database\Factories\PlanFactory;
use Database\Factories\ProfileFactory;
use Database\Factories\UserFactory;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->uri = 'admin/plans';
    $this->user = UserFactory::new()->create();
});

it('should attach profile in plan', function () {
    $plan = PlanFactory::new()->create();
    $profile = ProfileFactory::new()->create();

    $response = $this->actingAs($this->user)->post("{$this->uri}/{$plan->url}/profiles", [
        'profiles' => [$profile->id],
    ]);

    $response->assertSessionHasNoErrors();
    $response->assertStatus(Response::HTTP_FOUND);
});

it('should return 404 status code when not found', function () {
    $response = $this->actingAs($this->user)->post("{$this->uri}/zzz/profiles", [
        'profiles' => [1],
    ]);

    $response->assertNotFound();
});
