<?php

namespace Interfaces\Http\Api\Order\Controllers;

use Domains\Orders\Actions\QueryOrdersByClientIdAction;
use Illuminate\Http\Request;
use Infrastructure\Shared\Controller;
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
}
