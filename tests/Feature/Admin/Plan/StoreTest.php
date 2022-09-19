<?php

use Illuminate\Http\Response;
use Infrastructure\Persistence\Eloquent\Models\Plan;
use Infrastructure\Persistence\Eloquent\Models\User;

beforeEach(function () {
    $this->uri = 'admin/plans';
    $this->user = User::factory()->create();
});

it('Should create plan', function () {
    $plan = Plan::factory()->definition();

    $response = $this->post($this->uri, $plan);

    $response->assertStatus(Response::HTTP_FOUND);
});

it('should return 422 when there are no required params', function () {
    $response = $this->actingAs($this->user)->post($this->uri);

    $response->assertSessionHasErrors(['name', 'price']);
});
