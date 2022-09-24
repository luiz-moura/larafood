<?php

use Application\Providers\RouteServiceProvider;
use Illuminate\Http\Response;
use Infrastructure\Persistence\Eloquent\Models\User;

beforeEach(function () {
    $this->uri = '/login';
    $this->user = User::factory()->create();
});

test('login screen can be rendered', function () {
    $response = $this->get($this->uri);

    $response->assertStatus(Response::HTTP_OK);
});

test('users can authenticate using the login screen', function () {
    $response = $this->post($this->uri, [
        'email' => $this->user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

test('users can not authenticate with invalid password', function () {
    $this->post($this->uri, [
        'email' => $this->user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});
