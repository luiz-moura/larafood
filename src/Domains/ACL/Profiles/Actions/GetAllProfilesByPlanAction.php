<?php

namespace Domains\ACL\Profiles\Actions;

use Domains\ACL\Profiles\Contracts\ProfileRepository;
use Domains\ACL\Profiles\DataTransferObjects\ProfilePaginatedData;
use Interfaces\Http\Profiles\DataTransferObjects\IndexProfileRequestData;

class GetAllProfilesByPlanAction
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function __invoke(int $planId, IndexProfileRequestData $paginationData, array $with = []): ProfilePaginatedData
    {
        return $this->profileRepository->getAllByPlan($planId, $paginationData, $with);
    }
}
