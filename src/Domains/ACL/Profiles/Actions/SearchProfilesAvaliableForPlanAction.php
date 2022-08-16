<?php

namespace Domains\ACL\Profiles\Actions;

use Domains\ACL\Profiles\Contracts\ProfileRepository;
use Domains\ACL\Profiles\DataTransferObjects\ProfilesPaginatedData;
use Domains\ACL\Profiles\DataTransferObjects\SearchProfilesPaginationData;

class SearchProfilesAvaliableForPlanAction
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function __invoke(int $planId, SearchProfilesPaginationData $searchProfilesPaginationData, array $with = []): ProfilesPaginatedData
    {
        return $this->profileRepository->searchAvailableForPlan($planId, $searchProfilesPaginationData, $with);
    }
}
