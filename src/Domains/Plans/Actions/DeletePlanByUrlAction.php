<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\Exceptions\PlanNotFoundException;

class DeletePlanByUrlAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(string $url): bool
    {
        $plan = $this->planRepository->findByUrl($url);

        if (!$plan) {
            throw new PlanNotFoundException();
        }

        return $this->planRepository->deleteByUrl($url);
    }
}
