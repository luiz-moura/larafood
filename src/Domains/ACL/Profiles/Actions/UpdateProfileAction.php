<?php

namespace Domains\ACL\Profiles\Actions;

use Domains\ACL\Profiles\Contracts\ProfileRepository;
use Interfaces\Http\Profiles\DataTransferObjects\ProfileFormData;

class UpdateProfileAction
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function __invoke(int $id, ProfileFormData $formData): void
    {
        $this->profileRepository->update($id, $formData);
    }
}
