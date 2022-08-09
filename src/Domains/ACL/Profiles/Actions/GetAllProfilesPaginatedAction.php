<?php

namespace Domains\ACL\Profiles\Actions;

use Domains\ACL\Profiles\Contracts\ProfileRepository;
use Domains\ACL\Profiles\DataTransferObjects\IndexProfilesPaginationData;
use Domains\ACL\Profiles\DataTransferObjects\ProfilesPaginatedData;

class GetAllProfilesPaginatedAction
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function __invoke(IndexProfilesPaginationData $indexProfilesPaginationData): ProfilesPaginatedData
    {
        return $this->profileRepository->getAllProfilesPaginated($indexProfilesPaginationData);
    }
}