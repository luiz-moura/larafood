<?php

beforeEach(function () {
    $this->uri = '/api/auth/register';
});

it('should successfully register the client', function () {
    $payload = [
        'name' => 'Machado de Assis',
        'email' => 'test@hotmail.com',
        'password' => 'casmurro',
    ];
    $response = $this->post($this->uri, $payload);

    $response->assertOk()
        ->assertExactJson([
            'data' => [
                'name' => $payload['name'],
                'email' => $payload['email'],
            ],
        ]);
});

it('should fail when not informing the client data', function () {
    $response = $this->postJson($this->uri);

    $response->assertUnprocessable()
        ->assertExactJson([
            'message' => 'The name field is required. (and 2 more errors)',
            'errors' => [
                'name' => [__('validation.required', ['attribute' => 'name'])],
                'email' => [__('validation.required', ['attribute' => 'email'])],
                'password' => [__('validation.required', ['attribute' => 'password'])],
            ],
        ]);
});
