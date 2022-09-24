<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;

class AttachProfilesInPlanAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(string $planUrl, array $profiles): void
    {
        $this->planRepository->attachProfilesInPlan($planUrl, $profiles);
    }
}
