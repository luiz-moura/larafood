<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\DataTransferObjects\{PlansPaginatedData, SearchPlansPaginationData};

class SearchPlanAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(SearchPlansPaginationData $plansPaginationData): PlansPaginatedData
    {
        return $this->planRepository->searchByNameAndDescription($plansPaginationData);
    }
}
