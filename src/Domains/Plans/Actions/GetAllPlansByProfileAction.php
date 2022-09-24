<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\DataTransferObjects\PlanPaginatedData;
use Interfaces\Http\Plans\DataTransferObjects\IndexPlanRequestData;

class GetAllPlansByProfileAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(int $profileId, IndexPlanRequestData $paginationData, array $with = []): PlanPaginatedData
    {
        return $this->planRepository->getAllByProfile($profileId, $paginationData, $with);
    }
}
