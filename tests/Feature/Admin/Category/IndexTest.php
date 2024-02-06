<?php

use Database\Factories\CategoryFactory;
use Database\Factories\UserFactory;

beforeEach(function () {
    $this->uri = 'admin/categories';
    $this->user = UserFactory::new()->create();
});

it('should return all categories', function () {
    $category = CategoryFactory::new()->create(['tenant_id' => $this->user->tenant_id]);

    $response = $this->actingAs($this->user)->get($this->uri);

    $response->assertOk();
    $response->assertSee($category->name);
});
