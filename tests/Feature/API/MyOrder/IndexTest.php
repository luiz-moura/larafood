<?php

use Database\Factories\ClientFactory;
use Database\Factories\OrderFactory;
use Database\Factories\ProductFactory;
use Database\Factories\TenantFactory;

beforeEach(function () {
    $this->uri = 'api/v1/my-orders';
    $this->company = TenantFactory::new()->create();
    $this->header = ['company_token' => $this->company->uuid];
});

it('should fail when no user authenticated', function () {
    OrderFactory::new()->create(['tenant_id' => $this->company->id, 'client_id' => null]);

    $response = $this->withHeaders($this->header)->getJson($this->uri);

    $response->assertUnauthorized();
});

it('should successfully store order with client', function () {
    $client = ClientFactory::new()->create();
    [$firstOrder, $secondOrder] = OrderFactory::new()
        ->count(2)
        ->create(['client_id' => $client->id, 'tenant_id' => $this->company->id])
        ->load('table')
        ->all();

    $bike = ProductFactory::new()->create(['name' => 'Bike', 'tenant_id' => $this->company->id]);
    $car = ProductFactory::new()->create(['name' => 'Car', 'tenant_id' => $this->company->id]);

    $firstOrder->products()->attach($bike, ['price' => $bike->price, 'quantity' => 2]);
    $secondOrder->products()->attach($car, ['price' => $car->price, 'quantity' => 3]);

    $response = $this->actingAs($client)
        ->withHeaders($this->header)
        ->getJson($this->uri);

    $response->assertOk()
        ->assertJsonFragment([
            'client' => null,
            'status' => 'open',
            'table' => [
                'identify' => $firstOrder->table->uuid,
                'name' => $firstOrder->table->identify,
                'description' => $firstOrder->table->description,
            ],
            'products' => [
                [
                    'identify' => $bike->uuid,
                    'name' => $bike->name,
                    'flag' => $bike->flag,
                    'image' => url("storage/{$bike->image}"),
                    'price' => $bike->price,
                    'description' => $bike->description,
                ],
            ],
            'total' => $firstOrder->total,
        ])->assertJsonFragment([
            'status' => 'open',
            'client' => null,
            'table' => [
                'identify' => $secondOrder->table->uuid,
                'name' => $secondOrder->table->identify,
                'description' => $secondOrder->table->description,
            ],
            'products' => [
                [
                    'identify' => $car->uuid,
                    'name' => $car->name,
                    'flag' => $car->flag,
                    'image' => url("storage/{$car->image}"),
                    'price' => $car->price,
                    'description' => $car->description,
                ],
            ],
            'total' => $secondOrder->total,
        ]);
});
