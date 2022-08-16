<?php

namespace Domains\ACL\Profiles\Actions;

use Domains\ACL\Profiles\Contracts\ProfileRepository;
use Domains\ACL\Profiles\DataTransferObjects\IndexProfilesPaginationData;
use Domains\ACL\Profiles\DataTransferObjects\ProfilesPaginatedData;

class GetAllProfilesByPlanIdPaginatedAction
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function __invoke(int $planId, IndexProfilesPaginationData $indexProfilesPaginationData, array $with = []): ProfilesPaginatedData
    {
        return $this->profileRepository->getAllForPlan($planId, $indexProfilesPaginationData, $with);
    }
}
