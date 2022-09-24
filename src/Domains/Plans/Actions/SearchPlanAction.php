<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\DataTransferObjects\PlanPaginatedData;
use Interfaces\Http\Plans\DataTransferObjects\SearchPlanRequestData;

class SearchPlanAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(SearchPlanRequestData $paginationData): PlanPaginatedData
    {
        return $this->planRepository->queryByNameAndDescription($paginationData);
    }
}
