<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\ArgumentsObject;

class RootGetPaymentOrderArgumentsObject extends ArgumentsObject
{
    protected $cartId;

    protected $id;

    public function setCartId($cartId): static
    {
        $this->cartId = $cartId;

        return $this;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }
}
