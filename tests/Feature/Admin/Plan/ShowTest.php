
<?php

use Database\Factories\PlanFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/plans';
    $this->user = UserFactory::new()->create();
});

it('Should show plan', function () {
    $plan = PlanFactory::new()->create();

    $response = $this->actingAs($this->user)->get("{$this->uri}/{$plan->url}");

    $response->assertOk();
    $response->assertSee($plan->name);
    $response->assertSee($plan->description);
});

it('Should return 404 status code when not found', function () {
    $response = $this->actingAs($this->user)->get("{$this->uri}/zzzzzz");

    $response->assertNotFound();
});
