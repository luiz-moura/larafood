<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanDetailRepository;
use Domains\Plans\DataTransferObjects\PlanDetailData;

class FindPlanDetailAction
{
    public function __construct(private PlanDetailRepository $planDetailRepository)
    {
    }

    public function __invoke(int $id): PlanDetailData
    {
        return $this->planDetailRepository->findById($id);
    }
}
