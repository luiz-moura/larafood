<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\DataTransferObjects\PlansData;
use Domains\Plans\Exceptions\PlanNotFoundException;

class UpdatePlanAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(string $url, PlansData $planData): bool
    {
        $plan = $this->planRepository->findByUrl($url);

        if (!$plan) {
            throw new PlanNotFoundException();
        }

        return $this->planRepository->updateByUrl($url, $planData);
    }
}
