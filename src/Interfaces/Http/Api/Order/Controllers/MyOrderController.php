<?php

namespace Interfaces\Http\Api\Order\Controllers;

use Domains\Orders\Actions\QueryOrdersByClientIdAction;
use Domains\Orders\UseCases\CreateOrderUseCase;
use Illuminate\Http\Request;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Api\Order\Requests\StoreOrderRequest;
use Interfaces\Http\Api\Order\Resources\OrderResource;

class MyOrderController extends Controller
{
    public function index(
        Request $request,
        QueryOrdersByClientIdAction $queryOrdersByClientIdAction
    ) {
        $clientId = auth()->user()->id;

        $orders = $queryOrdersByClientIdAction($clientId, $request->companyToken);

        return OrderResource::collection($orders);
    }

    public function store(
        StoreOrderRequest $request,
        CreateOrderUseCase $createOrderUseCase,
    ) {
        $validatedRequest = $request->validated();
        $clientId = auth()->user()->id;

        $order = $createOrderUseCase($validatedRequest, $clientId);

        return OrderResource::make($order);
    }
}
