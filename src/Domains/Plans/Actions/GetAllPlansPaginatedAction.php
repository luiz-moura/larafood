<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\DataTransferObjects\{IndexPlansPaginationData, PlansPaginatedData, PlansPaginationData};

class GetAllPlansPaginatedAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(IndexPlansPaginationData $plansPaginationData): PlansPaginatedData
    {
        return $this->planRepository->queryAllWithFilterPaginated($plansPaginationData);
    }
}
