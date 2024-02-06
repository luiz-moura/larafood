<?php

namespace Domains\Evaluations\Actions;

use Domains\Evaluations\Contracts\EvaluationRepository;
use Domains\Evaluations\DataTransferObjects\EvaluationData;
use Interfaces\Http\Api\OrderEvaluation\DataTransferObjects\OrderEvaluationFormData;

class CreateEvaluationAction
{
    public function __construct(private EvaluationRepository $evaluationRepository)
    {
    }

    public function __invoke(OrderEvaluationFormData $evaluation, int $orderId, int $clientId): EvaluationData
    {
        return $this->evaluationRepository->create($evaluation, $orderId, $clientId);
    }
}
