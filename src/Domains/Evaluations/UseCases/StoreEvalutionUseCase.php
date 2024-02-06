<?php

namespace Domains\Evaluations\UseCases;

use Domains\Evaluations\Actions\CreateEvaluationAction;
use Domains\Orders\Contracts\OrderRepository;
use Domains\Orders\Exceptions\OrderIsNotFromTheCustomerException;
use Interfaces\Http\Api\OrderEvaluation\DataTransferObjects\OrderEvaluationFormData;

class StoreEvalutionUseCase
{
    public function __construct(
        private CreateEvaluationAction $createEvaluationAction,
        private OrderRepository $orderRepository
    ) {
    }

    public function __invoke(
        OrderEvaluationFormData $evaluation,
        string $orderIdentify,
        int $clientId
    ) {
        $order = $this->orderRepository->findByIdentify($orderIdentify, ['client', 'products', 'table']);

        throw_if($order->client_id && $order->client_id !== $clientId, OrderIsNotFromTheCustomerException::class);

        $evaluation = ($this->createEvaluationAction)($evaluation, $order->id, $clientId);
        $evaluation->order = $order;
        $evaluation->client = $order->client;

        return $evaluation;
    }
}
