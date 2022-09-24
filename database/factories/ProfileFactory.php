<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Persistence\Eloquent\Models\Profile;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition()
    {
        return $this->mock();
    }

    public function mock()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(255),
        ];
    }
}
