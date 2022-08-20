<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\DataTransferObjects\PlansCollection;

class GetAllPlansAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(array $with = []): PlansCollection
    {
        return $this->planRepository->getAll($with);
    }
}
