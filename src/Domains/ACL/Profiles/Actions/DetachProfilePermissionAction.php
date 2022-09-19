<?php

namespace Domains\ACL\Profiles\Actions;

use Domains\ACL\Profiles\Contracts\ProfileRepository;

class DetachProfilePermissionAction
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function __invoke(int $profileId, int $permissionId): void
    {
        $this->profileRepository->detachProfilePermission($profileId, $permissionId);
    }
}
