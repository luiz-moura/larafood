<?php

namespace Infrastructure\Contracts;

interface DataTransferObjectContract
{
    public static function arrayOf(array $arrayOfParameters): array;
    public function all(): array;
    public function toArray(): array;
}
