<?php

namespace Interfaces\Http\Api\Order\Controllers;

use Domains\ACL\Clients\DataTransferObjects\ClientData;
use Domains\Orders\Actions\FindOrderByUuidAndTenantUuidAction;
use Domains\Orders\Exceptions\OrderIsNotFromTheCustomerException;
use Domains\Orders\UseCases\CreateOrderUseCase;
use Illuminate\Http\Request;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Api\Order\DataTransferObjects\OrderFormData;
use Interfaces\Http\Api\Order\Requests\StoreOrderRequest;
use Interfaces\Http\Api\Order\Resources\OrderResource;

class OrderController extends Controller
{
    public function store(
        StoreOrderRequest $request,
        CreateOrderUseCase $createOrderUseCase,
    ) {
        $client = auth()->hasUser() ? ClientData::fromArray($request->user()->toArray()) : null;
        $orderForm = OrderFormData::fromRequest($request->validated());

        $order = $createOrderUseCase($orderForm, $request->companyToken, $client);

        return OrderResource::make($order);
    }

    public function show(
        string $identify,
        Request $request,
        FindOrderByUuidAndTenantUuidAction $findOrderByUuidAndTenantUuidAction
    ) {
        $order = $findOrderByUuidAndTenantUuidAction(
            $identify,
            $request->companyToken,
            withRelations: ['client', 'products', 'table']
        );

        $clientId = auth()->user()?->id;
        throw_if($order->client_id && $order->client_id !== $clientId, OrderIsNotFromTheCustomerException::class);

        return OrderResource::make($order);
    }
}
