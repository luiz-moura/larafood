<?php

namespace Domains\ACL\Profiles\Actions;

use Domains\ACL\Profiles\Contracts\ProfileRepository;
use Domains\ACL\Profiles\DataTransferObjects\ProfileData;

class FindProfileAction
{
    public function __construct(private ProfileRepository $planRepository)
    {
    }

    public function __invoke(int $id, array $with = []): ProfileData
    {
        return $this->planRepository->findById($id, $with);
    }
}
