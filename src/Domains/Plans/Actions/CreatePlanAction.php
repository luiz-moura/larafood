<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Interfaces\Http\Plans\DataTransferObjects\PlanFormData;

class CreatePlanAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(PlanFormData $formData): void
    {
        $this->planRepository->create($formData);
    }
}
