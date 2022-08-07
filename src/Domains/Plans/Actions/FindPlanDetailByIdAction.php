<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanDetailRepository;
use Domains\Plans\DataTransferObjects\PlanDetailsData;

class FindPlanDetailByIdAction
{
    public function __construct(private PlanDetailRepository $planDetailRepository)
    {
    }

    public function __invoke(int $id): PlanDetailsData
    {
        return $this->planDetailRepository->findById($id);
    }
}
