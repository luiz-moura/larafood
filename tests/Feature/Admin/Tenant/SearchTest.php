<?php

use Database\Factories\TenantFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/tenants/search';
    $this->user = UserFactory::new()->create();
});

it('should find by name', function () {
    $tenant = TenantFactory::new()->create(['name' => 'Federal burguer']);

    $response = $this->actingAs($this->user)->get("{$this->uri}?filter=federal");

    $response->assertOk();
    $response->assertSee($tenant->name);
});
