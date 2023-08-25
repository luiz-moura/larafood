<?php

namespace Domains\Orders\Actions;

use Domains\Orders\Contracts\OrderRepository;
use Domains\Orders\DataTransferObjects\OrderProductCollection;
use Domains\Orders\DataTransferObjects\ProductWithQuantityCollection;

class AttachProductsToOrderAction
{
    public function __construct(private OrderRepository $orderRepository)
    {
    }

    public function __invoke(int $orderId, ProductWithQuantityCollection $productsWithQuantity): void
    {
        $orderProducts = OrderProductCollection::fromArray(
            $productsWithQuantity->mapWithKeys(function ($productWithQuantity) {
                return [$productWithQuantity->product->id => [
                    'product_id' => $productWithQuantity->product->id,
                    'price' => $productWithQuantity->product->price,
                    'quantity' => $productWithQuantity->quantity,
                ]];
            })->toArray()
        );

        $this->orderRepository->attachProducts($orderId, $orderProducts);
    }
}
