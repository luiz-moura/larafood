<?php

use Database\Factories\ClientFactory;
use Database\Factories\OrderFactory;
use Database\Factories\ProductFactory;
use Database\Factories\TenantFactory;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->uri = 'api/v1/orders';
    $this->company = TenantFactory::new()->create();
    $this->header = ['company_token' => $this->company->uuid];
    $this->client = ClientFactory::new()->create();

    $this->order = OrderFactory::new()->create(['tenant_id' => $this->company->id, 'client_id' => $this->client->id]);
    $this->echoDot = ProductFactory::new()->create(['tenant_id' => $this->company->id, 'name' => 'Echo Dot']);
    $this->order->products()->attach($this->echoDot->id, ['price' => $this->echoDot->price, 'quantity' => 1]);
});

it('should successfully store order evaluation', function () {
    $payload = [
        'stars' => 5,
        'comment' => 'nice :3',
    ];
    $response = $this->withHeaders($this->header)
        ->actingAs($this->client)
        ->postJson("{$this->uri}/{$this->order->identify}/evaluations", $payload);

    $this->order->load('table');

    $response->assertOk()
        ->assertExactJson([
            'data' => [
                'stars' => $payload['stars'],
                'comment' => $payload['comment'],
                'client' => [
                    'name' => $this->client->name,
                    'email' => $this->client->email,
                ],
                'order' => [
                    'identify' => $this->order->identify,
                    'total' => $this->order->total,
                    'status' => $this->order->status,
                    'client' => [
                        'name' => $this->client->name,
                        'email' => $this->client->email,
                    ],
                    'products' => [
                        [
                            'company_token' => $this->echoDot->tenant->uuid,
                            'identify' => $this->echoDot->uuid,
                            'flag' => $this->echoDot->flag,
                            'name' => $this->echoDot->name,
                            'image' => url("storage/{$this->echoDot->image}"),
                            'price' => $this->echoDot->price,
                            'description' => $this->echoDot->description,
                        ],
                    ],
                    'table' => [
                        'identify' => $this->order->table->uuid,
                        'name' => $this->order->table->identify,
                        'description' => $this->order->table->description,
                    ],
                ],
            ],
        ]);
});

it('should fail when no user authenticated', function () {
    $payload = [
        'stars' => 5,
        'comment' => 'nice :3',
    ];
    $response = $this->withHeaders($this->header)
        ->postJson("{$this->uri}/{$this->order->identify}/evaluations", $payload);

    $response->assertUnauthorized();
});

it('should fail when it doesnt find the order', function () {
    $orderInvalid = Str::uuid();
    $payload = [
        'stars' => 5,
        'comment' => 'nice :3',
    ];
    $response = $this->withHeaders($this->header)
        ->actingAs($this->client)
        ->postJson("{$this->uri}/{$orderInvalid}/evaluations", $payload);

    $response->assertNotFound();
});

it('should fail when order evaluation does not have required params', function () {
    $response = $this->withHeaders($this->header)
        ->actingAs($this->client)
        ->postJson("{$this->uri}/{$this->order->identify}/evaluations");

    $response->assertUnprocessable()
        ->assertJsonFragment([
            'errors' => [
                'stars' => [__('validation.required', ['attribute' => 'stars'])],
            ],
        ]);
});
