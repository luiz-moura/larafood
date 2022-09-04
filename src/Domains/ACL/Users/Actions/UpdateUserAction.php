<?php

namespace Domains\ACL\Users\Actions;

use Domains\ACL\Users\DataTransferObjects\UsersFormData;
use Domains\ACL\Users\Repositories\UserRepository;

class UpdateUserAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(int $id, UsersFormData $userFormData)
    {
        $this->userRepository->update($id, $userFormData);
    }
}
