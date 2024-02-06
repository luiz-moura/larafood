<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\Exceptions\CannotDeletePlanWithTenantsException;

class DeletePlanByUrlAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(string $url): void
    {
        $hasTenants = $this->planRepository->hasTenants($url);

        throw_if($hasTenants, CannotDeletePlanWithTenantsException::class);

        $this->planRepository->deleteByUrl($url);
    }
}
