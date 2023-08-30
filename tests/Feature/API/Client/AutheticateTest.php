<?php

use Database\Factories\ClientFactory;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    $this->uri = '/api/auth/authenticate';
});

it('should successfully authenticate the client', function () {
    $password = 'casmurro';
    $client = ClientFactory::new()->create([
        'email' => 'test@hotmail.com',
        'password' => Hash::make('casmurro'),
    ]);
    $payload = [
        'email' => $client->email,
        'password' => $password,
        'device_name' => 'ryzen',
    ];

    $response = $this->postJson($this->uri, $payload);

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                'email',
                'token',
            ],
        ]);
});

it('should fail when chedentials are invalid', function () {
    $payload = [
        'email' => 'userwithoutregistration@hotmail.com',
        'password' => 'from1to8',
        'device_name' => 'intel',
    ];
    $response = $this->postJson($this->uri, $payload);

    $response->assertUnprocessable()
        ->assertExactJson([
            'message' => __('auth.failed'),
            'errors' => [
                'email' => [__('auth.failed')],
            ],
        ]);
});

it('should fail when not informing the client chedentials', function () {
    $response = $this->postJson($this->uri);

    $response->assertUnprocessable()
        ->assertExactJson([
            'message' => 'The email field is required. (and 2 more errors)',
            'errors' => [
                'device_name' => [__('validation.required', ['attribute' => 'device name'])],
                'email' => [__('validation.required', ['attribute' => 'email'])],
                'password' => [__('validation.required', ['attribute' => 'password'])],
            ],
        ]);
});
