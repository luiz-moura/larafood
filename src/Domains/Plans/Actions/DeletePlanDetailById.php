<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanDetailRepository;
use Domains\Plans\Exceptions\PlanDetailDoesNotBelongsToPlanException;

class DeletePlanDetailById
{
    public function __construct(private PlanDetailRepository $planDetailRepository)
    {
    }

    public function __invoke(string $planUrl, int $planDetailId): bool
    {
        $detailDoesNotBelongsToPlan = $this->planDetailRepository->checkIfDetailDoesNotBelongToPlan($planUrl, $planDetailId);

        if ($detailDoesNotBelongsToPlan) {
            throw new PlanDetailDoesNotBelongsToPlanException();
        }

        return $this->planDetailRepository->delete($planDetailId);
    }
}
