<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Persistence\Eloquent\Models\Table;

class TableFactory extends Factory
{
    protected $model = Table::class;

    public function definition()
    {
        return [
            ...$this->mock(),
            'tenant_id' => TenantFactory::new()->create()->id,
        ];
    }

    public function mock(?array $extra = []): array
    {
        return $extra + [
            'id' => $this->faker->unique()->randomNumber(),
            'uuid' => $this->faker->uuid(),
            'tenant_id' => $this->faker->randomDigit(),
            'identify' => $this->faker->colorName(),
            'description' => $this->faker->sentence(),
            'created_at' => now()->format('Y-m-d H:i:s'),
            'updated_at' => null,
        ];
    }
}
