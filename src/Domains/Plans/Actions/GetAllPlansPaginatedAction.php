<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\DataTransferObjects\PlanPaginatedData;
use Interfaces\Http\Plans\DataTransferObjects\IndexPlanRequestData;

class GetAllPlansPaginatedAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(IndexPlanRequestData $paginationData): PlanPaginatedData
    {
        return $this->planRepository->getAllPaginated($paginationData);
    }
}
