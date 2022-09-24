<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Persistence\Eloquent\Models\Plan;

class PlanFactory extends Factory
{
    protected $model = Plan::class;

    public function definition()
    {
        return $this->mock();
    }

    public function mock()
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomNumber(),
            'description' => $this->faker->text(255),
        ];
    }
}
