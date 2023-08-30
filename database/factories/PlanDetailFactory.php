<?php

namespace Database\Factories;

use Infrastructure\Persistence\Eloquent\Models\PlanDetail;
use Infrastructure\Shared\AbstractFactory;

class PlanDetailFactory extends AbstractFactory
{
    protected $model = PlanDetail::class;

    public function definition(): array
    {
        return [
            ...$this->mock(),
            'plan_id' => PlanFactory::new()->create()->id,
        ];
    }

    public function mock(array $extra = []): array
    {
        return $extra + [
            'plan_id' => $this->faker->randomDigit(),
            'name' => $this->faker->name(),
            'created_at' => now()->format('Y-m-d H:i:s'),
            'updated_at' => null,
        ];
    }
}
