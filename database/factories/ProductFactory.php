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
            'tenant_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(255),
            'price' => $this->faker->randomNumber(),
            'image' => $this->faker->filePath(),
            'flag' => $this->faker->boolean(),
        ];
    }
}
