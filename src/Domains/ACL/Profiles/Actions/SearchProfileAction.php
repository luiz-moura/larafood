<?php

namespace Domains\ACL\Profiles\Actions;

use Domains\ACL\Profiles\Contracts\ProfileRepository;
use Domains\ACL\Profiles\DataTransferObjects\SearchProfilesPaginationData;

class SearchProfileAction
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function __invoke(SearchProfilesPaginationData $searchProfilesPaginationData)
    {
        return $this->profileRepository->searchByNameAndDescription($searchProfilesPaginationData);
    }
}
