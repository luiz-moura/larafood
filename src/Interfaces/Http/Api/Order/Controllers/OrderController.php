<?php

namespace Interfaces\Http\Api\Order\Controllers;

use Domains\Orders\Actions\FindOrderByUuidAndTenantUuidAction;
use Domains\Orders\UseCases\CreateOrderUseCase;
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
        $orderForm = OrderFormData::fromRequest($request->validated());

        $order = $createOrderUseCase($orderForm, $request->companyToken);

        return OrderResource::make($order);
    }

    public function show(
        string $companyToken,
        string $identify,
        FindOrderByUuidAndTenantUuidAction $findOrderByUuidAndTenantUuidAction
    ) {
        $order = $findOrderByUuidAndTenantUuidAction(
            $identify,
            $companyToken,
            with: ['client', 'products', 'table']
        );

        return OrderResource::make($order);
    }
}
