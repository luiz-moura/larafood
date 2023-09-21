<?php

namespace Domains\ACL\Users\Actions;

use Domains\ACL\Users\Contracts\UserRepository;
use Interfaces\Http\Users\DataTransferObjects\UserFormData;

class CreateUserAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(int $tenantId, UserFormData $userFormData): void
    {
        $this->userRepository->create($tenantId, $userFormData);
    }
}
