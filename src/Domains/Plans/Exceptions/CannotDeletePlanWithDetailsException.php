<?php

namespace Domains\Plans\Exceptions;

use Domains\Shared\Exceptions\ResponseException;
use Illuminate\Http\Response;

class CannotDeletePlanWithDetailsException extends ResponseException
{
    public function __construct()
    {
        parent::__construct(
            'Não é possível excluir plano que possua detalhes!',
            Response::HTTP_NOT_FOUND
        );
    }
}
