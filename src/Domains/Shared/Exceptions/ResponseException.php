<?php

namespace Domains\Shared\Exceptions;

use Exception;

abstract class ResponseException extends Exception
{
    private array $errors;

    public function __construct(string $message, int $code, array $errors = [])
    {
        $this->code = $code;
        $this->message = $message;
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
