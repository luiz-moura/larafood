<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanDetailRepository;
use Domains\Plans\DataTransferObjects\IndexPlanDetailsPaginationData;
use Domains\Plans\DataTransferObjects\PlanDetailsPaginatedData;

class GetPlanDetailsByPlanPaginatedAction
{
    public function __construct(private PlanDetailRepository $planDetailRepository)
    {
    }

    public function __invoke(int $planId, IndexPlanDetailsPaginationData $indexPlanDetailsPaginationData): PlanDetailsPaginatedData
    {
        return $this->planDetailRepository->getByPlanIdPaginated($planId, $indexPlanDetailsPaginationData);
    }
}
