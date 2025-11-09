<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class CartItemQuantity
{
    public protected(set) ?int $cart_item_id = null;

    public protected(set) ?float $quantity = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['cart_item_id']) && $data['cart_item_id'] !== null) {
            $instance->cart_item_id = $data['cart_item_id'];
        }
        if (isset($data['quantity']) && $data['quantity'] !== null) {
            $instance->quantity = $data['quantity'];
        }

        return $instance;
    }

    public static function fromJson(string $json): self
    {
        $data = json_decode($json, true);
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid JSON provided to fromJson method: '.json_last_error_msg());
        }

        return self::fromArray($data);
    }

    /**
     * Converts this object to an array.
     */
    public function asArray(): array
    {
        $data = [];
        if ($this->cart_item_id !== null) {
            $data['cart_item_id'] = $this->cart_item_id;
        }
        if ($this->quantity !== null) {
            $data['quantity'] = $this->quantity;
        }

        return $data;
    }
}
