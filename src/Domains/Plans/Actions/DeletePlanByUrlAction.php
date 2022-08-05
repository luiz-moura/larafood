<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;

class DeletePlanByUrlAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(string $url): bool
    {
        return $this->planRepository->deleteByUrl($url);
    }
}
