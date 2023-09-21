<?php

namespace Domains\ACL\Users\Actions;

use Domains\ACL\Users\Contracts\UserRepository;

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
