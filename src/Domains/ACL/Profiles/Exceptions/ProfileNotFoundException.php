<?php

namespace Domains\ACL\Profiles\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ProfileNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            'Perfil não encontrado!',
            Response::HTTP_NOT_FOUND
        );
    }
}
