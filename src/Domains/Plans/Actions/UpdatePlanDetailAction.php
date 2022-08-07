<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanDetailRepository;
use Domains\Plans\DataTransferObjects\PlanDetailsData;

class UpdatePlanDetailAction
{
    public function __construct(private PlanDetailRepository $planDetailRepository)
    {
    }

    public function __invoke(int $planDetailId, PlanDetailsData $planDetailData): bool
    {
        return $this->planDetailRepository->update($planDetailId, $planDetailData);
    }
}
