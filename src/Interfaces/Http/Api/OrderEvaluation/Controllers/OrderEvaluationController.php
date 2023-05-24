<?php

namespace Interfaces\Http\Api\OrderEvaluation\Controllers;

use Domains\Evaluations\Actions\CreateEvaluationAction;
use Domains\Orders\Actions\FindOrderByUuidAndTenantUuidAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Api\OrderEvaluation\DataTransferObjects\OrderEvaluationFormData;
use Interfaces\Http\Api\OrderEvaluation\Requests\StoreOrderEvaluationRequest;
use Interfaces\Http\Api\OrderEvaluation\Resources\OrderEvaluationResource;

class OrderEvaluationController extends Controller
{
    public function store(
        string $companyToken,
        string $orderIdentify,
        StoreOrderEvaluationRequest $request,
        CreateEvaluationAction $createEvaluationAction,
        FindOrderByUuidAndTenantUuidAction $findOrderByUuidAndTenantUuidAction
    ) {
        $evaluation = OrderEvaluationFormData::fromRequest($request->validated());
        $order = $findOrderByUuidAndTenantUuidAction($orderIdentify, $companyToken);
        $clientId = auth()->user()->id;

        $evaluation = $createEvaluationAction($evaluation, $order->id, $clientId);

        return OrderEvaluationResource::make($evaluation);
    }
}
