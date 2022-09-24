<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Persistence\Eloquent\Models\Plan;
use Infrastructure\Persistence\Eloquent\Models\PlanDetail;

class PlanDetailFactory extends Factory
{
    protected $model = PlanDetail::class;

    public function definition()
    {
        return [
            'plan_id' => Plan::factory()->create()->id,
            ...$this->mock(),
        ];
    }

    public function mock()
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
