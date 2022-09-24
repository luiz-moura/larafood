<?php

namespace Domains\ACL\Profiles\Actions;

use Domains\ACL\Profiles\Contracts\ProfileRepository;
use Interfaces\Http\Profiles\DataTransferObjects\ProfileFormData;

class CreateProfileAction
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function __invoke(ProfileFormData $formData): void
    {
        $this->profileRepository->create($formData);
    }
}
