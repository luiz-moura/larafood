<?php

namespace Domains\ACL\Users\Actions;

use Domains\ACL\Users\Repositories\UserRepository;

class AttachRolesInUserAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(int $id, array $roles): void
    {
        $this->userRepository->attachRoles($id, $roles);
    }
}
