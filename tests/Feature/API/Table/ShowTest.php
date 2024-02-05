<?php

use Database\Factories\TableFactory;
use Database\Factories\TenantFactory;
use Illuminate\Support\Str;

uses()->group('api');

beforeEach(function () {
    $this->uri = 'api/v1/tables';
    $this->company = TenantFactory::new()->create();
    $this->header = [
        'company_token' => $this->company->uuid,
    ];
});

it('should show table', function () {
    $table = TableFactory::new()->create(['tenant_id' => $this->company->id]);

    $response = $this->withHeaders($this->header)
        ->get("{$this->uri}/{$table->uuid}");

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                'identify',
                'name',
                'description',
            ],
        ]);
});

it('should return 404 status code when not found', function () {
    $tableIdInvalid = Str::uuid();
    $response = $this->withHeaders($this->header)
        ->get("{$this->uri}/{$tableIdInvalid}");

    $response->assertNotFound();
});
