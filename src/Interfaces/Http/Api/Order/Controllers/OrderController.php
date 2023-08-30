<?php

namespace Interfaces\Http\Api\Order\Controllers;

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
        $clientId = auth()->user()?->id;
        $orderForm = OrderFormData::fromRequest($request->validated());

        $order = $createOrderUseCase($orderForm, $request->companyToken, $clientId);

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
