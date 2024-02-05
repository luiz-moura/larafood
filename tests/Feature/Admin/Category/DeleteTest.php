<?php

use Database\Factories\CategoryFactory;
use Database\Factories\UserFactory;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->uri = 'admin/categories';
    $this->user = UserFactory::new()->create();
});

it('should delete category', function () {
    $category = CategoryFactory::new(['tenant_id' => $this->user->tenant_id])->create();

    $response = $this->actingAs($this->user)->delete("{$this->uri}/{$category->id}");

    $response->assertSessionHasNoErrors();
    $response->assertStatus(Response::HTTP_FOUND);
});

it('should return status code 404 when not found', function () {
    $response = $this->actingAs($this->user)->delete("{$this->uri}/9999999");

    $response->assertNotFound();
});
