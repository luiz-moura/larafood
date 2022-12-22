<?php

use Application\Providers\RouteServiceProvider;
use Database\Factories\UserFactory;
use Illuminate\Http\Response;
use Infrastructure\Persistence\Eloquent\Models\User;

beforeEach(function () {
    $this->uri = '/login';
    $this->user = UserFactory::new()->create();
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
