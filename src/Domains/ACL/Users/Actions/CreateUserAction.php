<?php

namespace Domains\ACL\Users;

use Domains\ACL\Users\DataTransferObjects\UsersFormData;
use Domains\ACL\Users\Repositories\UserRepository;

class CreateUserAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(UsersFormData $userFormData)
    {
        $this->userRepository->create($userFormData);
    }
}
