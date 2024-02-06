<?php

namespace Database\Factories;

use Infrastructure\Persistence\Eloquent\Models\Category;
use Infrastructure\Shared\AbstractFactory;

class CategoryFactory extends AbstractFactory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            ...$this->mock(),
            'tenant_id' => TenantFactory::new()->create()->id,
        ];
    }

    public function mock(array $extra = []): array
    {
        return $extra + [
            'tenant_id' => $this->faker->randomDigit(),
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->unique()->name,
            'url' => $this->faker->url(),
            'description' => $this->faker->sentence(),
            'created_at' => now()->format('Y-m-d H:i:s'),
            'updated_at' => null,
        ];
    }
}
