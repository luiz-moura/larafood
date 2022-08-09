<?php

namespace Domains\ACL\Permissions\Exceptions;

use Exception;
use Illuminate\Http\Response;

class PermissionNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            'Permissão não encontrada!',
            Response::HTTP_NOT_FOUND
        );
    }
}
