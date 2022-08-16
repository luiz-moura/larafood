<?php

namespace Domains\ACL\Profiles\Actions;

use Domains\ACL\Profiles\Contracts\ProfileRepository;
use Domains\ACL\Profiles\DataTransferObjects\ProfilesPaginatedData;
use Domains\ACL\Profiles\DataTransferObjects\SearchProfilesPaginationData;

class SearchProfileForPlanAction
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function __invoke(int $planId, SearchProfilesPaginationData $indexProfilesPaginationData, array $with = []): ProfilesPaginatedData
    {
        return $this->profileRepository->searchForPlan($planId, $indexProfilesPaginationData, $with);
    }
}
