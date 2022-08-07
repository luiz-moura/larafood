<?php

namespace Domains\Plans\Exceptions;

use Domains\Shared\Exceptions\ResponseException;
use Illuminate\Http\Response;

class PlanDetailDoesNotBelongsToPlanException extends ResponseException
{
    public function __construct()
    {
        parent::__construct(
            'Este detalhe não pertence a este plano!',
            Response::HTTP_PRECONDITION_FAILED
        );
    }
}
