<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\DataTransferObjects\PlanData;

class CreatePlanAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(PlanData $plan): bool
    {
        return $this->planRepository->create($plan);
    }
}
