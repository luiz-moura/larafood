<?php

namespace Domains\ACL\Profiles\Actions;

use Domains\ACL\Profiles\Contracts\ProfileRepository;
use Domains\ACL\Profiles\DataTransferObjects\ProfilePaginatedData;
use Interfaces\Http\Profiles\DataTransferObjects\SearchProfileRequestData;

class SearchProfileByPlanAction
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function __invoke(int $planId, SearchProfileRequestData $paginationData, array $with = []): ProfilePaginatedData
    {
        return $this->profileRepository->queryByPlan($planId, $paginationData, $with);
    }
}
