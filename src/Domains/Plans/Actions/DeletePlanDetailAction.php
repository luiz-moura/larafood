<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanDetailRepository;
use Domains\Plans\Exceptions\PlanDetailDoesNotBelongsToPlanException;

class DeletePlanDetailAction
{
    public function __construct(private PlanDetailRepository $planDetailRepository)
    {
    }

    public function __invoke(string $planUrl, int $planDetailId): void
    {
        $detailDoesNotBelongsToPlan = $this->planDetailRepository->checkIfDetailDoesNotBelongToPlan($planUrl, $planDetailId);

        throw_if($detailDoesNotBelongsToPlan, PlanDetailDoesNotBelongsToPlanException::class);

        $this->planDetailRepository->delete($planDetailId);
    }
}
