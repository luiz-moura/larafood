<?php

use Database\Factories\CategoryFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/categories';
    $this->user = UserFactory::new()->create();
});

it('should edit category', function () {
    $category = CategoryFactory::new()->create(['tenant_id' => $this->user->tenant_id]);

    $response = $this->actingAs($this->user)->get("{$this->uri}/{$category->id}/edit");

    $response->assertOk();
    $response->assertSee($category->name);
    $response->assertSee($category->description);
    $response->assertSee($category->slug);
});

it('should return 404 status code when not found', function () {
    $response = $this->actingAs($this->user)->get("{$this->uri}/999999/edit");

    $response->assertNotFound();
});
