<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanDetailRepository;
use Domains\Plans\DataTransferObjects\PlanDetailPaginatedData;
use Interfaces\Http\PlanDetails\DataTransferObjects\IndexPlanDetailRequestData;

class GetAllPlanDetailsByPlanAction
{
    public function __construct(private PlanDetailRepository $planDetailRepository)
    {
    }

    public function __invoke(int $planId, IndexPlanDetailRequestData $paginationData): PlanDetailPaginatedData
    {
        return $this->planDetailRepository->getAllByPlan($planId, $paginationData);
    }
}
