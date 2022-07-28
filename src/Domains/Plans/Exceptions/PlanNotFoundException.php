<?php

namespace Domains\Plans\Exceptions;

use Domains\Shared\Exceptions\ResponseException;
use Illuminate\Http\Response;

class PlanNotFoundException extends ResponseException
{
    public function __construct()
    {
        parent::__construct(
            'Plano não encontrado!',
            Response::HTTP_NOT_FOUND
        );
    }
}
