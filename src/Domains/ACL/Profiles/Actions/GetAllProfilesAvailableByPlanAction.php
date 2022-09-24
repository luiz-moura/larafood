<?php

namespace Domains\ACL\Profiles\Actions;

use Domains\ACL\Profiles\Contracts\ProfileRepository;
use Domains\ACL\Profiles\DataTransferObjects\ProfilePaginatedData;
use Interfaces\Http\Profiles\DataTransferObjects\IndexProfileRequestData;

class GetAllProfilesAvailableByPlanAction
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function __invoke(int $planId, IndexProfileRequestData $paginationData): ProfilePaginatedData
    {
        return $this->profileRepository->getAllAvailableByPlan($planId, $paginationData);
    }
}
