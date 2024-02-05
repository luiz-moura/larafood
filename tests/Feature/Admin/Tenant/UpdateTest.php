<?php

use Database\Factories\TenantFactory;
use Database\Factories\UserFactory;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

beforeEach(function () {
    $this->uri = 'admin/tenants';
    $this->user = UserFactory::new()->create();
    $this->tenant = TenantFactory::new()->create(['name' => 'Federal burguer']);
    $file = UploadedFile::fake()->image('image.jpg');
    $this->form = ['logo' => $file] + TenantFactory::new()->mock();
});

it('should update tenant', function () {
    $response = $this->actingAs($this->user)->put(
        "{$this->uri}/{$this->tenant->id}",
        $this->form
    );

    $response->assertSessionHasNoErrors();
    $response->assertStatus(Response::HTTP_FOUND);
});

it('should update tenant without image', function () {
    $response = $this->actingAs($this->user)->put(
        "{$this->uri}/{$this->tenant->id}",
        Arr::except($this->form, 'logo')
    );

    $response->assertSessionHasNoErrors();
    $response->assertStatus(Response::HTTP_FOUND);
});

it('should return errors when there are no required params', function () {
    $response = $this->actingAs($this->user)->put("{$this->uri}/{$this->tenant->id}");

    $response->assertSessionHasErrors([
        'name',
        'email',
        'cnpj',
        'active',
        'subscribed_at',
        'expires_at',
        'subscription_id',
        'subscription_active',
        'subscription_suspended',
    ]);
});

it('should return status code 404 when not found', function () {
    $response = $this->actingAs($this->user)->put(
        "{$this->uri}/99999",
        $this->form
    );

    $response->assertNotFound();
});
