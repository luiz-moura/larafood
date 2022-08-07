<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\DataTransferObjects\PlansData;

class UpdatePlanAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(string $url, PlansData $planData): bool
    {
        return $this->planRepository->updateByUrl($url, $planData);
    }
}
