<?php

namespace Interfaces\Http\Api\OrderEvaluation\Controllers;

use Domains\Evaluations\UseCases\StoreEvalutionUseCase;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Api\OrderEvaluation\DataTransferObjects\OrderEvaluationFormData;
use Interfaces\Http\Api\OrderEvaluation\Requests\StoreOrderEvaluationRequest;
use Interfaces\Http\Api\OrderEvaluation\Resources\OrderEvaluationResource;

class OrderEvaluationController extends Controller
{
    public function store(
        string $orderIdentify,
        StoreOrderEvaluationRequest $request,
        StoreEvalutionUseCase $useCase,
    ) {
        $evaluation = OrderEvaluationFormData::fromRequest($request->validated());

        $clientId = auth()->user()->id;
        $evaluation = $useCase($evaluation, $orderIdentify, $clientId);

        return OrderEvaluationResource::make($evaluation);
    }
}
