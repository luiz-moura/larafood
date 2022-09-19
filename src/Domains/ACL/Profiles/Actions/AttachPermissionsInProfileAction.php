<?php

namespace Domains\ACL\Profiles\Actions;

use Domains\ACL\Profiles\Contracts\ProfileRepository;

class AttachPermissionsInProfileAction
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function __invoke(int $profileId, array $permissions): void
    {
        $this->profileRepository->attachPermissionsInProfile($profileId, $permissions);
    }
}
