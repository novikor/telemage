<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\ArgumentsObject;

class RootCartArgumentsObject extends ArgumentsObject
{
    protected $cart_id;

    public function setCartId($cartId): static
    {
        $this->cart_id = $cartId;

        return $this;
    }
}
