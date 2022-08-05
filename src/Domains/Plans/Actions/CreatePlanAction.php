<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\DataTransferObjects\PlansData;

class CreatePlanAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(PlansData $planData): bool
    {
        return $this->planRepository->create($planData);
    }
}
