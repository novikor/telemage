<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class CartItemInterface
{
    public protected(set) ?string $uid = null;

    public protected(set) ?float $quantity = null;

    public protected(set) ?ProductInterface $product = null;

    public static function fromArray(array $data): static
    {
        $instance = new static;
        if (isset($data['uid'])) {
            $instance->uid = $data['uid'];
        }
        if (isset($data['quantity'])) {
            $instance->quantity = $data['quantity'];
        }
        if (isset($data['product'])) {
            $instance->product = ProductInterface::fromArray($data['product']);
        }

        return $instance;
    }
}
