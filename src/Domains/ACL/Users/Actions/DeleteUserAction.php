<?php

namespace Domains\ACL\Users\Actions;

use Domains\ACL\Users\Contracts\UserRepository;

class DeleteUserAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(int $id): void
    {
        $this->userRepository->delete($id);
    }
}
