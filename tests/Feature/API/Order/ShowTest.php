<?php

use Database\Factories\ClientFactory;
use Database\Factories\OrderFactory;
use Database\Factories\TenantFactory;

uses()->group('api');

beforeEach(function () {
    $this->uri = 'api/v1/orders';
    $this->company = TenantFactory::new()->create();
    $this->header = ['company_token' => $this->company->uuid];
});

it('should fail when accessing order without userlient', function () {
    $order = OrderFactory::new()->create(['tenant_id' => $this->company->id, 'client_id' => null]);

    $response = $this->withHeaders($this->header)->getJson("{$this->uri}/{$order->identify}");

    $response->assertUnauthorized();
});

it('should successfully return order', function () {
    $client = ClientFactory::new()->create();
    $order = OrderFactory::new()->create(['tenant_id' => $this->company->id, 'client_id' => $client->id]);

    $response = $this->actingAs($client)
        ->withHeaders($this->header)
        ->getJson("{$this->uri}/{$order->identify}");

    $response->assertOk();
});

it('should fail when the order is from another client', function () {
    $client = ClientFactory::new()->create();

    $anotherClient = ClientFactory::new()->create();
    $order = OrderFactory::new()->create(['tenant_id' => $this->company->id, 'client_id' => $anotherClient->id]);

    $response = $this->actingAs($client)
        ->withHeaders($this->header)
        ->getJson("{$this->uri}/{$order->identify}");

    $response->assertForbidden()
        ->assertJsonFragment([
            'message' => 'O pedido não pertence a você.',
            'errors' => [],
        ]);
});
