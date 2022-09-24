<?php

namespace Domains\Plans\Actions;

use Domains\Plans\Contracts\PlanRepository;
use Domains\Plans\Exceptions\CannotDeletePlanWithDetailsException;

class DeletePlanByUrlAction
{
    public function __construct(private PlanRepository $planRepository)
    {
    }

    public function __invoke(string $url): void
    {
        $hasDetail = $this->planRepository->hasDetail($url);

        throw_if($hasDetail, CannotDeletePlanWithDetailsException::class);

        $this->planRepository->deleteByUrl($url);
    }
}
