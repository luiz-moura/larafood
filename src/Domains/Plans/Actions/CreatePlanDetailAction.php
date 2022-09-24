<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanDetailRepository;
use Interfaces\Http\PlanDetails\DataTransferObjects\PlanDetailFormData;

class CreatePlanDetailAction
{
    public function __construct(private PlanDetailRepository $planDetailRepository)
    {
    }

    public function __invoke(int $planId, PlanDetailFormData $formData): void
    {
        $this->planDetailRepository->create($planId, $formData);
    }
}
