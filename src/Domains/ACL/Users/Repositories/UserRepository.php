<?php

namespace Domains\ACL\Users\Repositories;

use Domains\ACL\Users\DataTransferObjects\UsersFormData;
use Domains\ACL\Users\DataTransferObjects\UsersModelData;

interface UserRepository
{
    public function create(UsersFormData $userFormData): UsersModelData;
}
