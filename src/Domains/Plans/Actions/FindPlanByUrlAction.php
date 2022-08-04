<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\DataTransferObjects\PlansData;
use Domains\Plans\Exceptions\PlanNotFoundException;

class FindPlanByUrlAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(string $url): PlansData
    {
        $plan = $this->planRepository->findByUrl($url);

        if (!$plan) {
            throw new PlanNotFoundException();
        }

        return $plan;
    }
}
