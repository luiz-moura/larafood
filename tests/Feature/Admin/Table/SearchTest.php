<?php

use Database\Factories\TableFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/tables/search';
    $this->user = UserFactory::new()->create();
});

it('should find by description', function () {
    $table = TableFactory::new()->create(['tenant_id' => $this->user->tenant_id, 'description' => 'Yellow table']);

    $response = $this->actingAs($this->user)->get("{$this->uri}?filter=yellow");

    $response->assertOk();
    $response->assertSee($table->identify);
});
