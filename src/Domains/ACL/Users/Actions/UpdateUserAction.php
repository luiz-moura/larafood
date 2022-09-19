<?php

namespace Domains\ACL\Users\Actions;

use Domains\ACL\Users\Repositories\UserRepository;
use Interfaces\Http\Users\DataTransferObjects\UserFormData;

class UpdateUserAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(int $id, UserFormData $userFormData): void
    {
        $this->userRepository->update($id, $userFormData);
    }
}
