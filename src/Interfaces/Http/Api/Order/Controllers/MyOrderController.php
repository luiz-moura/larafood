<?php

namespace Interfaces\Http\Api\Order\Controllers;

use Domains\Orders\Actions\QueryOrdersByClientIdAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Api\Order\Resources\OrderResource;

class MyOrderController extends Controller
{
    public function index(QueryOrdersByClientIdAction $queryOrdersByClientIdAction)
    {
        $clientId = auth()->user()->id;

        $orders = $queryOrdersByClientIdAction($clientId, withRelations: ['products', 'table', 'client']);

        return OrderResource::collection($orders);
    }
}
