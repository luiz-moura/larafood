<?php

use Database\Factories\PlanFactory;
use Database\Factories\UserFactory;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->uri = 'admin/plans';
    $this->user = UserFactory::new()->create();
});

it('Should create plan', function () {
    $formData = PlanFactory::new()->mock();

    $response = $this->actingAs($this->user)->post($this->uri, $formData);

    $response->assertSessionHasNoErrors();
    $response->assertStatus(Response::HTTP_FOUND);
});

it('should return errors when there are no required params', function () {
    $response = $this->actingAs($this->user)->post($this->uri);

    $response->assertSessionHasErrors(['name', 'price']);
});
