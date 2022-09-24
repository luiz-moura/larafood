<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Interfaces\Http\Plans\DataTransferObjects\PlanFormData;

class UpdatePlanAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(string $url, PlanFormData $formData): bool
    {
        return $this->planRepository->updateByUrl($url, $formData);
    }
}
