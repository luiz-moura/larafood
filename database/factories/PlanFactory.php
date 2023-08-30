<?php

namespace Database\Factories;

use Infrastructure\Persistence\Eloquent\Models\Plan;
use Infrastructure\Shared\AbstractFactory;

class PlanFactory extends AbstractFactory
{
    protected $model = Plan::class;

    public function definition(): array
    {
        return $this->mock();
    }

    public function mock(array $extra = []): array
    {
        return $extra + [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomNumber(),
            'description' => $this->faker->sentence(),
            'created_at' => now()->format('Y-m-d H:i:s'),
            'updated_at' => null,
        ];
    }
}
