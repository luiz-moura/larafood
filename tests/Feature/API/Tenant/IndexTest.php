<?php

use Database\Factories\TenantFactory;

uses()->group('api');

beforeEach(function () {
    $this->uri = 'api/v1/tenants';
});

it('should return all tenants', function () {
    TenantFactory::new()->count(5)->create();

    $response = $this->get($this->uri);

    $response->assertOk()
        ->assertJsonCount(5, 'data');
});
