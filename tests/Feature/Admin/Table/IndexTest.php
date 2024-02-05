<?php

use Database\Factories\TableFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/tables';
    $this->user = UserFactory::new()->create();
});

it('should return all tables', function () {
    $table = TableFactory::new()->create(['tenant_id' => $this->user->tenant_id]);

    $response = $this->actingAs($this->user)->get($this->uri);

    $response->assertOk();
    $response->assertSee($table->name);
});
