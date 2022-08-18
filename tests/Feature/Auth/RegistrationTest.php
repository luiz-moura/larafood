<?php

use Application\Providers\RouteServiceProvider;

beforeEach(function () {
    $this->uri = '/register';
});

test('registration screen can be rendered', function () {
    $response = $this->get($this->uri);

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post($this->uri, [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
