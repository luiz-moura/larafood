<?php

namespace Domains\Shared\Exceptions;

use Exception;

abstract class ResponseException extends Exception
{
    public function __construct(
        protected $message,
        protected $code,
        protected array $errors = []
    ) {
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
