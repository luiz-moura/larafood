<?php

namespace Domains\ACL\Users\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

class UsersFormData extends DataTransferObject
{
    public string $name;
    public string $email;
    public ?string $password;
}
