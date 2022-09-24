<?php

use Application\Providers\RouteServiceProvider;
use Illuminate\Http\Response;
use Infrastructure\Persistence\Eloquent\Models\Plan;

beforeEach(function () {
    $this->uri = '/register';
    $plan = Plan::factory()->create();
    $this->session(['plan' => $plan]);
});

test('registration screen can be rendered', function () {
    $response = $this->get($this->uri);

    $response->assertStatus(Response::HTTP_OK);
});

test('new users can register', function () {
    $response = $this->post("{$this->uri}/", [
        'name' => 'Test User',
        'company' => 'Test Company',
        'email' => 'test@example.com',
        'cnpj' => '12345678912345',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
