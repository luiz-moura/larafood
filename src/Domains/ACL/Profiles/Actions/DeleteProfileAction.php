<?php

namespace Domains\ACL\Profiles\Actions;

use Domains\ACL\Profiles\Contracts\ProfileRepository;

class DeleteProfileAction
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function __invoke(int $id): bool
    {
        return $this->profileRepository->delete($id);
    }
}
