<?php

namespace Domains\Orders\Actions;

use Domains\Orders\Contracts\OrderRepository;
use Illuminate\Support\Str;

class GenerateUniqueIdentifierAction
{
    public function __construct(private OrderRepository $orderRepository)
    {
    }

    public function __invoke(): string
    {
        $identify = Str::random(10);

        if ($this->orderRepository->checksIfOrderExistsByIdentifier($identify)) {
            return self::__invoke();
        }

        return $identify;
    }
}
