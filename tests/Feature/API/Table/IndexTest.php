<?php

use Database\Factories\TableFactory;
use Database\Factories\TenantFactory;

uses()->group('api');

beforeEach(function () {
    $this->uri = 'api/v1/tables';
    $this->company = TenantFactory::new()->create();
});

it('should return all tables', function () {
    TableFactory::new()->count(5)->create(['tenant_id' => $this->company->id]);

    $response = $this->withHeaders([
        'company_token' => $this->company->uuid,
    ])->get($this->uri);

    $response->assertOk()
        ->assertJsonCount(5, 'data');
});
