<?php

namespace Database\Factories;

use Infrastructure\Persistence\Eloquent\Models\Plan;
use Infrastructure\Persistence\Eloquent\Models\PlanDetail;
use Infrastructure\Shared\AbstractFactory;

class PlanDetailFactory extends AbstractFactory
{
    protected $model = PlanDetail::class;

    public function definition(): array
    {
        return [
            ...$this->mock(),
            'plan_id' => Plan::factory()->create()->id,
        ];
    }

    public function mock(array $extra = []): array
    {
        return $extra + [
            'plan_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
        ];
    }
}
