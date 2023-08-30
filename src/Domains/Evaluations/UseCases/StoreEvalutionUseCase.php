<?php

namespace Domains\Evaluations\UseCases;

use Domains\Evaluations\Actions\CreateEvaluationAction;
use Domains\Orders\Actions\FindOrderByUuidAndTenantUuidAction;
use Interfaces\Http\Api\OrderEvaluation\DataTransferObjects\OrderEvaluationFormData;

class StoreEvalutionUseCase
{
    public function __construct(
        private CreateEvaluationAction $createEvaluationAction,
        private FindOrderByUuidAndTenantUuidAction $findOrderByUuidAndTenantUuidAction
    ) {
    }

    public function __invoke(
        OrderEvaluationFormData $evaluation,
        string $orderIdentify,
        string $companyToken,
        int $clientId
    ) {
        $order = ($this->findOrderByUuidAndTenantUuidAction)($orderIdentify, $companyToken);

        throw_if($order->client_id && $order->client_id !== $clientId, OrderIsNotFromTheCustomerException::class);

        return ($this->createEvaluationAction)($evaluation, $order->id, $clientId);
    }
}
