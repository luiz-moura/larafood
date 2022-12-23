<?php

use Database\Factories\UserFactory;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->uri = '/confirm-password';
    $this->user = UserFactory::new()->create();
});

test('confirm password screen can be rendered', function () {
    $response = $this->actingAs($this->user)->get($this->uri);

    $response->assertStatus(Response::HTTP_OK);
});

test('password can be confirmed', function () {
    $response = $this->actingAs($this->user)->post($this->uri, [
        'password' => 'password',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasNoErrors();
});

test('password is not confirmed with invalid password', function () {
    $response = $this->actingAs($this->user)->post($this->uri, [
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();
});
