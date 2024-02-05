<?php

use Database\Factories\CategoryFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/categories/search';
    $this->user = UserFactory::new()->create();
});

it('should find by name', function () {
    $category = CategoryFactory::new()->create(['tenant_id' => $this->user->tenant_id, 'name' => 'Pizza']);

    $response = $this->actingAs($this->user)->get("{$this->uri}?filter=pizza");

    $response->assertOk();
    $response->assertSee($category->name);
});
