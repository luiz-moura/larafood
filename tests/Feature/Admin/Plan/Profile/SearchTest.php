<?php

use Database\Factories\PlanFactory;
use Database\Factories\ProfileFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/plans';
    $this->user = UserFactory::new()->create();
    $this->plan = PlanFactory::new()->has(ProfileFactory::new(['name' => 'Test']))->create();
});

it('Should see profile in search', function () {
    $response = $this->actingAs($this->user)->get(
        "{$this->uri}/{$this->plan->url}/profiles?filter=Test"
    );

    $response->assertOk();
    $response->assertSee('Test');
});
