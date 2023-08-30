<?php

use Database\Factories\ClientFactory;

beforeEach(function () {
    $this->uri = '/api/auth/logout';
});

it('should fail when user is not authenticated', function () {
    $response = $this->getJson($this->uri);

    $response->assertUnauthorized();
});

it('should disconnect successfully', function () {
    $client = ClientFactory::new()->create();
    $token = $client->createToken('ryzen', ['*'])->plainTextToken;

    $response = $this->getJson($this->uri, [
        'Authorization' => "Bearer {$token}",
    ]);

    $response->assertNoContent();
});
