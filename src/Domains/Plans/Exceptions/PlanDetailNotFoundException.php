<?php

namespace Domains\Plans\Exceptions;

use Domains\Shared\Exceptions\ResponseException;
use Illuminate\Http\Response;

class PlanDetailNotFoundException extends ResponseException
{
    public function __construct()
    {
        parent::__construct(
            'Detalhe do plano não encontrado!',
            Response::HTTP_NOT_FOUND
        );
    }
}
