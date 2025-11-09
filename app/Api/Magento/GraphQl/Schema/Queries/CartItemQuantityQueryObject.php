<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CartItemQuantityQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CartItemQuantity';

    #[\Deprecated(message: 'The `ShippingCartAddress.cart_items` field now returns `CartItemInterface`.')]
    public function selectCartItemId(): static
    {
        $this->selectField('cart_item_id');

        return $this;
    }

    #[\Deprecated(message: 'The `ShippingCartAddress.cart_items` field now returns `CartItemInterface`.')]
    public function selectQuantity(): static
    {
        $this->selectField('quantity');

        return $this;
    }
}
