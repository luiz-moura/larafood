<?php

namespace Interfaces\Http\Api\Order\Controllers;

use Domains\ACL\Clients\DataTransferObjects\ClientData;
use Domains\Orders\UseCases\CreateOrderUseCase;
use Domains\Orders\UseCases\FindOrderByUuidAndTenantUuidAUseCase;
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
        $client = ClientData::fromArray($request->user()->toArray());
        $orderForm = OrderFormData::fromRequest($request->validated());
        $order = $createOrderUseCase($orderForm, $request->get('companyToken'), $client);

        return OrderResource::make($order);
    }

    public function show(
        string $identify,
        FindOrderByUuidAndTenantUuidAUseCase $findOrderByUuidAndTenantUuidAction
    ) {
        $order = $findOrderByUuidAndTenantUuidAction($identify, withRelations: ['client', 'products', 'table']);

        return OrderResource::make($order);
    }
}
