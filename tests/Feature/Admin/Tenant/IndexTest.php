<?php

use Database\Factories\TenantFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/tenants';
    $this->user = UserFactory::new()->create();
});

it('should return all tenants', function () {
    $tenant = TenantFactory::new()->create(['name' => 'Federal burguer']);

    $response = $this->actingAs($this->user)->get($this->uri);

    $response->assertOk();
    $response->assertSee($tenant->name);
});
