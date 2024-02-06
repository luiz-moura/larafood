<?php

use Database\Factories\TenantFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/tenants';
    $this->user = UserFactory::new()->create();
});

it('should edit tenant', function () {
    $tenant = TenantFactory::new()->create(['name' => 'Federal burguer']);

    $response = $this->actingAs($this->user)->get("{$this->uri}/{$tenant->id}/edit");

    $response->assertOk();
    $response->assertSee($tenant->name);
    $response->assertSee($tenant->email);
    $response->assertSee($tenant->cnpj);
});

it('should return 404 status code when not found', function () {
    $response = $this->actingAs($this->user)->get("{$this->uri}/999999/edit");

    $response->assertNotFound();
});
