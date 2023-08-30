<?php

namespace Domains\Orders\Exceptions;

use Domains\Shared\Exceptions\ResponseException;
use Illuminate\Http\Response;

class OrderIsNotFromTheCustomerException extends ResponseException
{
    public function __construct()
    {
        parent::__construct(
            'O pedido é de outro cliente.',
            Response::HTTP_UNAUTHORIZED
        );
    }
}
