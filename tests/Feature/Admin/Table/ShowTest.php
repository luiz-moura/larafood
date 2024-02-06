<?php

use Database\Factories\TableFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/tables';
    $this->user = UserFactory::new()->create();
});

it('should show table', function () {
    $table = TableFactory::new()->create(['tenant_id' => $this->user->tenant_id]);

    $response = $this->actingAs($this->user)->get("{$this->uri}/{$table->id}");

    $response->assertOk();
    $response->assertSee($table->name);
    $response->assertSee($table->email);
    $response->assertSee($table->cnpj);
});

it('should return 404 status code when not found', function () {
    $response = $this->actingAs($this->user)->get("{$this->uri}/999999");

    $response->assertNotFound();
});
