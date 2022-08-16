<?php

namespace Infrastructure\Shared;

abstract class AbstractFactory
{
    abstract public function create(array $parameters = []): DataTransferObject;

    abstract public function createMock(array $parameters = []): array;

    public static function new(): self
    {
        return new static();
    }
}
