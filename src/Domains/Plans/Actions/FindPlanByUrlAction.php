<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\DataTransferObjects\PlanData;

class FindPlanByUrlAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(string $url): PlanData
    {
        return $this->planRepository->findByUrl($url);
    }
}
