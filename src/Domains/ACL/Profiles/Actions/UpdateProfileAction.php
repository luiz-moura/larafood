<?php

namespace Domains\ACL\Profiles\Actions;

use Domains\ACL\Profiles\Contracts\ProfileRepository;
use Domains\ACL\Profiles\DataTransferObjects\ProfilesData;

class UpdateProfileAction
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function __invoke(int $id, ProfilesData $profileData): bool
    {
        return $this->profileRepository->update($id, $profileData);
    }
}
