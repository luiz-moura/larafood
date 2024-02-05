<?php

use Database\Factories\TableFactory;
use Database\Factories\UserFactory;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->uri = 'admin/tables';
    $this->user = UserFactory::new()->create();
    $this->table = TableFactory::new()->create(['tenant_id' => $this->user->tenant_id]);
    $this->form = [
        'identify' => 'table_10',
        'description' => 'Table 10',
    ];
});

it('should update table', function () {
    $response = $this->actingAs($this->user)->put(
        "{$this->uri}/{$this->table->id}",
        $this->form
    );

    $response->assertSessionHasNoErrors();
    $response->assertStatus(Response::HTTP_FOUND);
});

it('should return errors when there are no required params', function () {
    $response = $this->actingAs($this->user)->put("{$this->uri}/{$this->table->id}");

    $response->assertSessionHasErrors([
        'identify',
        'description',
    ]);
});

it('should return status code 404 when not found', function () {
    $response = $this->actingAs($this->user)->put(
        "{$this->uri}/99999",
        $this->form
    );

    $response->assertNotFound();
});
