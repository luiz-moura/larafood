<?php

use Database\Factories\PlanFactory;
use Database\Factories\UserFactory;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->uri = 'admin/plans';
    $this->user = UserFactory::new()->create();
    $this->plan = PlanFactory::new()->create();
    $this->formData = PlanFactory::new()->mock();
});

it('should update plan', function () {
    $response = $this->actingAs($this->user)->put(
        "{$this->uri}/{$this->plan->url}",
        $this->formData
    );

    $response->assertSessionHasNoErrors();
    $response->assertStatus(Response::HTTP_FOUND);
});

it('should return errors when there are no required params', function () {
    $response = $this->actingAs($this->user)->put("{$this->uri}/{$this->plan->url}");

    $response->assertSessionHasErrors(['name', 'description', 'price']);
});

it('should return status code 404 when not found', function () {
    $response = $this->actingAs($this->user)->put(
        "{$this->uri}/url-not-found",
        $this->formData
    );

    $response->assertNotFound();
});
