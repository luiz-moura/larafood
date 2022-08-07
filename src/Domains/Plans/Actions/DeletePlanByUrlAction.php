<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\Exceptions\CannotDeletePlanWithDetailsException;

class DeletePlanByUrlAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(string $url): bool
    {
        $planDetails = $this->planRepository->totalPlanDetailsByUrl($url);

        if ($planDetails) {
            throw new CannotDeletePlanWithDetailsException();
        }

        return $this->planRepository->deleteByUrl($url);
    }
}
