<?php

namespace Database\Factories;

use Domains\Tenants\Enums\TenantActiveEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Persistence\Eloquent\Models\Tenant;

class TenantFactory extends Factory
{
    protected $model = Tenant::class;

    public function definition()
    {
        return [
            ...$this->mock(),
            'plan_id' => PlanFactory::new()->create()->id,
        ];
    }

    public function mock()
    {
        return [
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
