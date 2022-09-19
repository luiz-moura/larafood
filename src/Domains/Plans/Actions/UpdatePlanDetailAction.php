<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanDetailRepository;
use Interfaces\Http\PlanDetails\DataTransferObjects\PlanDetailFormData;

class UpdatePlanDetailAction
{
    public function __construct(private PlanDetailRepository $planDetailRepository)
    {
    }

    public function __invoke(int $id, PlanDetailFormData $formData): bool
    {
        return $this->planDetailRepository->update($id, $formData);
    }
}
