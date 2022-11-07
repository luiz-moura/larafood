<?php

namespace Database\Factories;

use Domains\Tenants\Enums\TenantActiveEnum;
use Infrastructure\Persistence\Eloquent\Models\Tenant;
use Infrastructure\Shared\AbstractFactory;

class TenantFactory extends AbstractFactory
{
    protected $model = Tenant::class;

    public function definition(): array
    {
        return [
            ...$this->mock(),
            'plan_id' => PlanFactory::new()->create()->id,
        ];
    }

    public function mock(array $extra = []): array
    {
        return $extra + [
            'plan_id' => $this->faker->randomNumber(),
            'cnpj' => $this->faker->name(),
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'url' => $this->faker->url(),
            'logo' => $this->faker->filePath(),
            'active' => TenantActiveEnum::ACTIVE,
            'subscription_active' => $this->faker->boolean(),
            'subscription_suspended' => $this->faker->boolean(),
            'subscribed_at' => $this->faker->dateTime(),
            'expires_at' => $this->faker->dateTime(),
        ];
    }
}
