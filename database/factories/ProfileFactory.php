<?php

namespace Database\Factories;

use Infrastructure\Persistence\Eloquent\Models\Profile;
use Infrastructure\Shared\AbstractFactory;

class ProfileFactory extends AbstractFactory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return $this->mock();
    }

    public function mock(array $extra = []): array
    {
        return $extra + [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(255),
        ];
    }
}
