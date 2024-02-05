<?php

use Database\Factories\CategoryFactory;
use Database\Factories\UserFactory;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->uri = 'admin/categories';
    $this->user = UserFactory::new()->create();
    $this->category = CategoryFactory::new()->create(['tenant_id' => $this->user->tenant_id]);
    $this->form = [
        'name' => 'Market',
        'description' => 'Market',
    ];
});

it('should update category', function () {
    $response = $this->actingAs($this->user)->put(
        "{$this->uri}/{$this->category->id}",
        $this->form
    );

    $response->assertSessionHasNoErrors();
    $response->assertStatus(Response::HTTP_FOUND);
});

it('should return errors when there are no required params', function () {
    $response = $this->actingAs($this->user)->put("{$this->uri}/{$this->category->id}");

    $response->assertSessionHasErrors([
        'name',
    ]);
});

it('should return status code 404 when not found', function () {
    $response = $this->actingAs($this->user)->put(
        "{$this->uri}/99999",
        $this->form
    );

    $response->assertNotFound();
});
