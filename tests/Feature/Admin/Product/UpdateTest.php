<?php

use Database\Factories\ProductFactory;
use Database\Factories\UserFactory;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

beforeEach(function () {
    $this->uri = 'admin/products';
    $this->user = UserFactory::new()->create();
    $this->product = ProductFactory::new()->create([
        'tenant_id' => $this->user->tenant->id,
    ]);
    $file = UploadedFile::fake()->image('image.jpg');
    $this->formData = ProductFactory::new()->mock() + ['file' => $file];
});

it('should update product', function () {
    $response = $this->actingAs($this->user)->put(
        "{$this->uri}/{$this->product->id}",
        $this->formData
    );

    $response->assertSessionHasNoErrors();
    $response->assertStatus(Response::HTTP_FOUND);
});

it('should update product without image', function () {
    $response = $this->actingAs($this->user)->put(
        "{$this->uri}/{$this->product->id}",
        Arr::except($this->formData, 'file')
    );

    $response->assertSessionHasNoErrors();
    $response->assertStatus(Response::HTTP_FOUND);
});

it('should return errors when there are no required params', function () {
    $response = $this->actingAs($this->user)->put("{$this->uri}/{$this->product->id}");

    $response->assertSessionHasErrors(['name', 'price']);
});

it('should return status code 404 when not found', function () {
    $response = $this->actingAs($this->user)->put(
        "{$this->uri}/99999",
        $this->formData
    );

    $response->assertNotFound();
});
