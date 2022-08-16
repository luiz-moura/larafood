<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\DataTransferObjects\IndexPlansPaginationData;
use Domains\Plans\DataTransferObjects\PlansPaginatedData;

class GetAllPlansByProfileIdPaginatedAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(int $profileId, IndexPlansPaginationData $indexProfilesPaginationData, array $with = []): PlansPaginatedData
    {
        return $this->planRepository->getAllForProfile($profileId, $indexProfilesPaginationData, $with);
    }
}
