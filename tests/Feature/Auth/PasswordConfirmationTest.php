<?php

use Infrastructure\Persistence\Eloquent\Models\User;

beforeEach(function () {
    $this->uri = '/confirm-password';
    $this->user = User::factory()->create();
});

test('confirm password screen can be rendered', function () {
    $response = $this->actingAs($this->user)->get($this->uri);

    $response->assertStatus(200);
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
