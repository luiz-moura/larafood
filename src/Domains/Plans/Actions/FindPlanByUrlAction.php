<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\DataTransferObjects\PlanData;
use Domains\Plans\Exceptions\PlanNotFoundException;

class FindPlanByUrlAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(string $url): PlanData
    {
        $plan = $this->planRepository->findByUrl($url);

        if (!$plan) {
            throw new PlanNotFoundException();
        }

        return $plan;
    }
}
