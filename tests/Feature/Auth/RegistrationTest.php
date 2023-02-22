<?php

use Application\Providers\RouteServiceProvider;
use Database\Factories\PlanFactory;
use Database\Factories\RoleFactory;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->uri = '/register';
    $plan = PlanFactory::new()->create();
    $this->session(['plan' => $plan]);
});

test('registration screen can be rendered', function () {
    $response = $this->get($this->uri);

    $response->assertStatus(Response::HTTP_OK);
});

test('new users can register', function () {
    RoleFactory::new()->create(['id' => env('ROLE_ID_DEFAULT')]);

    $response = $this->post("{$this->uri}/", [
        'name' => 'Test User',
        'company' => 'Test Company',
        'email' => 'test@example.com',
        'cnpj' => '66.164.832/0001-51',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
