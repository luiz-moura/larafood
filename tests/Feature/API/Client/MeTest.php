<?php

use Database\Factories\ClientFactory;

uses()->group('api');

beforeEach(function () {
    $this->uri = '/api/auth/me';
});

it('should fail when user is not authenticated', function () {
    $response = $this->getJson($this->uri);

    $response->assertUnauthorized();
});

it('should successfully return client', function () {
    $client = ClientFactory::new()->create();
    $token = $client->createToken('ryzen', ['*'])->plainTextToken;

    $response = $this->getJson($this->uri, [
        'Authorization' => "Bearer {$token}",
    ]);

    $response->assertOk()
        ->assertExactJson([
            'data' => [
                'name' => $client->name,
                'email' => $client->email,
            ],
        ]);
});

it('should fail when chedentials are invalid', function () {
    $token = 'invalid-token';

    $response = $this->getJson($this->uri, [
        'Authorization' => "Bearer {$token}",
    ]);

    $response->assertUnauthorized();
});
