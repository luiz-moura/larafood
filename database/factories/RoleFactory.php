<?php

namespace Database\Factories;

use Infrastructure\Persistence\Eloquent\Models\Role;
use Infrastructure\Shared\AbstractFactory;

class RoleFactory extends AbstractFactory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return $this->mock();
    }

    public function mock(array $extra = []): array
    {
        return $extra + [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(255),
            'created_at' => now()->format('Y-m-d H:i:s'),
            'updated_at' => null,
        ];
    }
}
