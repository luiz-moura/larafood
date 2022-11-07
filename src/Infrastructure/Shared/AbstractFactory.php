<?php

namespace Infrastructure\Shared;

use Illuminate\Database\Eloquent\Factories\Factory;

abstract class AbstractFactory extends Factory
{
    abstract public function mock(array $parameters = []): array;
}
