<?php

namespace Domains\Plans\Exceptions;

use Domains\Shared\Exceptions\ResponseException;
use Illuminate\Http\Response;

class CannotDeletePlanWithTenantsException extends ResponseException
{
    public function __construct()
    {
        parent::__construct(
            'Não é possível excluir plano que possua empresas inscritas!',
            Response::HTTP_FORBIDDEN
        );
    }
}
