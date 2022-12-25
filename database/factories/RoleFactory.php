<?php

namespace Database\Factories;

use DateTime;
use Infrastructure\Persistence\Eloquent\Models\Role;
use Infrastructure\Shared\AbstractFactory;

class RoleFactory extends AbstractFactory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(255),
        ];
    }

    public function mock(array $extra = []): array
    {
        return array_merge(
            $this->definition(),
            [
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            $extra
        );
    }
}
