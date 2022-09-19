<?php

use Illuminate\Http\Response;
use Infrastructure\Persistence\Eloquent\Models\Plan;
use Infrastructure\Persistence\Eloquent\Models\User;

beforeEach(function () {
    $this->uri = 'admin/plans';
    $this->user = User::factory()->create();
    $this->plan = Plan::factory()->create();
    $this->formData = Plan::factory()->definition();
});

it('Should update plan', function () {
    $response = $this->actingAs($this->user)->put(
        "{$this->uri}/{$this->plan->url}",
        $this->formData
    );

    $response->assertStatus(Response::HTTP_FOUND);
});

it('should return 422 when there are no required params', function () {
    $response = $this->actingAs($this->user)->put("{$this->uri}/{$this->plan->url}");

    $response->assertSessionHasErrors(['name', 'description', 'price']);
});

it('Should return status code 404 when not found', function () {
    $response = $this->actingAs($this->user)->put(
        "{$this->uri}/url-not-found",
        $this->formData
    );

    $response->assertNotFound();
});
