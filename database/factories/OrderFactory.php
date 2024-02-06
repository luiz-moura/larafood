<?php

namespace Database\Factories;

use Domains\Orders\Enums\OrderStatusEnum;
use Infrastructure\Persistence\Eloquent\Models\Order;
use Infrastructure\Shared\AbstractFactory;

class OrderFactory extends AbstractFactory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            ...$this->mock(),
            'tenant_id' => TenantFactory::new()->create()->id,
            'client_id' => ClientFactory::new()->create()->id,
            'table_id' => TableFactory::new()->create()->id,
        ];
    }

    public function mock(array $extra = []): array
    {
        return $extra + [
            'tenant_id' => $this->faker->randomDigit(),
            'client_id' => $this->faker->randomElement([$this->faker->randomDigit(), null]),
            'table_id' => $this->faker->randomElement([$this->faker->randomDigit(), null]),
            'identify' => $this->faker->uuid(),
            'total' => $this->faker->randomNumber(),
            'status' => OrderStatusEnum::OPEN,
            'created_at' => now()->format('Y-m-d H:i:s'),
            'updated_at' => null,
        ];
    }
}
