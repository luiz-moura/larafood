<?php

namespace Database\Factories;

use Infrastructure\Persistence\Eloquent\Models\Product;
use Infrastructure\Shared\AbstractFactory;

class ProductFactory extends AbstractFactory
{
    protected $model = Product::class;

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
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomNumber(),
            'image' => $this->faker->filePath(),
            'flag' => $this->faker->boolean(),
            'created_at' => now()->format('Y-m-d H:i:s'),
            'updated_at' => null,
        ];
    }
}
