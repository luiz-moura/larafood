<?php

use Database\Factories\ClientFactory;
use Database\Factories\ProductFactory;
use Database\Factories\TableFactory;
use Database\Factories\TenantFactory;
use Illuminate\Support\Str;

uses()->group('api');

beforeEach(function () {
    $this->uri = 'api/v1/orders';
    $this->company = TenantFactory::new()->create();
    $this->header = ['company_token' => $this->company->uuid];
});

it('should fail when creating without client', function () {
    $product = ProductFactory::new()->create(['tenant_id' => $this->company->id]);

    $payload = [
        'products' => [[
            'identify' => $product->uuid,
            'quantity' => 3,
        ]],
    ];
    $response = $this->withHeaders($this->header)->postJson($this->uri, $payload);

    $response->assertUnauthorized();
});

it('should fail when product identify is invalid', function () {
    $client = ClientFactory::new()->create();
    $invalidProductIdentifier = Str::uuid();
    $payload = [
        'products' => [[
            'identify' => $invalidProductIdentifier,
            'quantity' => 3,
        ]],
    ];

    $response = $this->actingAs($client)
        ->withHeaders($this->header)
        ->postJson($this->uri, $payload);

    $response->assertUnprocessable()
        ->assertJsonFragment([
            'errors' => [
                'products.0.identify' => [__('validation.exists', ['attribute' => 'products.0.identify'])],
            ],
        ]);
});

it('should successfully store order with client', function () {
    $client = ClientFactory::new()->create();
    $product = ProductFactory::new()->create(['tenant_id' => $this->company->id]);

    $payload = [
        'products' => [[
            'identify' => $product->uuid,
            'quantity' => 3,
        ]],
    ];

    $response = $this->actingAs($client)
        ->withHeaders($this->header)
        ->postJson($this->uri, $payload);

    $response->assertOk()
        ->assertJsonFragment([
            'total' => $product->price * $payload['products'][0]['quantity'],
            'status' => 'open',
            'client' => [
                'name' => $client->name,
                'email' => $client->email,
            ],
            'table' => null,
            'products' => [
                [
                    'identify' => $product->uuid,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image_url' => url("storage/{$product->image}"),
                    'flag' => $product->flag,
                    'description' => $product->description,
                ],
            ],
        ]);
    expect($response->getData()->data)->toHaveProperty('identify');
});

it('should successfully store order with table and comment', function () {
    $client = ClientFactory::new()->create();
    $table = TableFactory::new()->create(['tenant_id' => $this->company->id]);
    $product = ProductFactory::new()->create(['tenant_id' => $this->company->id]);

    $payload = [
        'table' => $table->uuid,
        'comment' => 'without onion :)',
        'products' => [[
            'identify' => $product->uuid,
            'quantity' => 3,
        ]],
    ];

    $response = $this->actingAs($client)
        ->withHeaders($this->header)
        ->postJson($this->uri, $payload);

    $response->assertOk()
        ->assertJsonFragment([
            'total' => $product->price * $payload['products'][0]['quantity'],
            'status' => 'open',
            'client' => [
                'name' => $client->name,
                'email' => $client->email,
            ],
            'table' => [
                'identify' => $table->uuid,
                'name' => $table->identify,
                'description' => $table->description,
            ],
            'products' => [
                [
                    'identify' => $product->uuid,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image_url' => url("storage/{$product->image}"),
                    'flag' => $product->flag,
                    'description' => $product->description,
                ],
            ],
        ]);
    expect($response->getData()->data)->toHaveProperty('identify');
});

it('should fail when table identify is invalid', function () {
    $client = ClientFactory::new()->create();
    $tableInvalid = Str::uuid();
    $product = ProductFactory::new()->create(['tenant_id' => $this->company->id]);

    $payload = [
        'table' => $tableInvalid,
        'comment' => 'without onion :)',
        'products' => [[
            'identify' => $product->uuid,
            'quantity' => 3,
        ]],
    ];

    $response = $this->actingAs($client)
        ->withHeaders($this->header)
        ->postJson($this->uri, $payload);

    $response->assertUnprocessable()
        ->assertJsonFragment([
            'errors' => [
                'table' => [__('validation.exists', ['attribute' => 'table'])],
            ],
        ]);
});
