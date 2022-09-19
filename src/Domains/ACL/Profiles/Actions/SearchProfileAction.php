<?php

namespace Domains\ACL\Profiles\Actions;

use Domains\ACL\Profiles\Contracts\ProfileRepository;
use Domains\ACL\Profiles\DataTransferObjects\ProfilePaginatedData;
use Interfaces\Http\Profiles\DataTransferObjects\SearchProfileRequestData;

class SearchProfileAction
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function __invoke(SearchProfileRequestData $paginationData, array $with = []): ProfilePaginatedData
    {
        return $this->profileRepository->queryByNameAndDescription($paginationData, $with);
    }
}
