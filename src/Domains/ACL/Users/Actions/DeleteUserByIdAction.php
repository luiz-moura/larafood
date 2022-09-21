<?php

namespace Domains\ACL\Users\Actions;

use Domains\ACL\Users\Repositories\UserRepository;

class DeleteUserByIdAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(int $id): bool
    {
        return $this->userRepository->delete($id);
    }
}
