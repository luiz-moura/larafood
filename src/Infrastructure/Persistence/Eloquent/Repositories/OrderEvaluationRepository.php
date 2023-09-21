<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Evaluations\Contracts\EvaluationRepository;
use Domains\Evaluations\DataTransferObjects\EvaluationData;
use Infrastructure\Persistence\Eloquent\Models\OrderEvaluation;
use Infrastructure\Shared\AbstractRepository;
use Interfaces\Http\Api\OrderEvaluation\DataTransferObjects\OrderEvaluationFormData;

class OrderEvaluationRepository extends AbstractRepository implements EvaluationRepository
{
    protected $modelClass = OrderEvaluation::class;

    public function create(OrderEvaluationFormData $evaluation, int $orderId, int $clientId): EvaluationData
    {
        return EvaluationData::fromArray(
            $this->model->create(
                array_merge($evaluation->toArray(), [
                    'order_id' => $orderId,
                    'client_id' => $clientId,
                ])
            )->toArray()
        );
    }
}
