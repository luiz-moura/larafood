<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Infrastructure\Persistence\Eloquent\Models\User;
use Infrastructure\Shared\AbstractFactory;

class UserFactory extends AbstractFactory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            ...$this->mock(),
            'tenant_id' => TenantFactory::new()->create()->id,
        ];
    }

    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function mock(array $extra = []): array
    {
        return $extra + [
            'tenant_id' => $this->faker->randomDigit(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'admin' => $this->faker->boolean(100),
            'created_at' => now()->format('Y-m-d H:i:s'),
            'updated_at' => null,
        ];
    }
}
