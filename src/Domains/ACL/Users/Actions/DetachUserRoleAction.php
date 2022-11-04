<?php

namespace Domains\ACL\Users\Actions;

use Domains\ACL\Users\Repositories\UserRepository;

class DetachUserRoleAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(int $userId, int $roleId): void
    {
        $this->userRepository->detachRole($userId, $roleId);
    }
}
