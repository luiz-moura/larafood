<?php

use Database\Factories\PlanDetailFactory;
use Database\Factories\PlanFactory;
use Database\Factories\UserFactory;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->uri = 'admin/plans';
    $this->user = UserFactory::new()->create();
    $this->plan = PlanFactory::new()->has(PlanDetailFactory::new(), 'details')->create();
});

it('should delete detail for plan', function () {
    $response = $this->actingAs($this->user)->delete(
        "{$this->uri}/{$this->plan->url}/details/{$this->plan->details->first()->id}",
        PlanDetailFactory::new()->mock()
    );

    $response->assertSessionHasNoErrors();
    $response->assertStatus(Response::HTTP_FOUND);
});
