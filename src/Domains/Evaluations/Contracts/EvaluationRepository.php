<?php

namespace Domains\Evaluations\Contracts;

use Domains\Evaluations\DataTransferObjects\EvaluationData;
use Interfaces\Http\Api\OrderEvaluation\DataTransferObjects\OrderEvaluationFormData;

interface EvaluationRepository
{
    public function create(OrderEvaluationFormData $evaluation, int $orderId, int $clientId): EvaluationData;
}
