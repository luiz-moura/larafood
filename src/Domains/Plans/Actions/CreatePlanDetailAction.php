<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanDetailRepository;
use Domains\Plans\DataTransferObjects\PlanDetailsData;

class CreatePlanDetailAction
{
    public function __construct(private PlanDetailRepository $planDetailRepository)
    {
    }

    public function __invoke(PlanDetailsData $planDetailData): bool
    {
        return $this->planDetailRepository->create($planDetailData);
    }
}
