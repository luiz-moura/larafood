<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;

class DetachPlanProfileAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(string $planUrl, int $profileId): void
    {
        $this->planRepository->detachPlanProfile($planUrl, $profileId);
    }
}
