<?php

namespace Database\Factories;

use Infrastructure\Persistence\Eloquent\Models\Client;
use Infrastructure\Shared\AbstractFactory;

class ClientFactory extends AbstractFactory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return $this->mock();
    }

    public function mock(array $extra = []): array
    {
        return $extra + [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'created_at' => now()->format('Y-m-d H:i:s'),
            'updated_at' => null,
        ];
    }
}
