<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CartItemInterfaceQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CartItemInterface';

    public function selectUid(): self
    {
        $this->selectField('uid');

        return $this;
    }

    public function selectQuantity(): self
    {
        $this->selectField('quantity');

        return $this;
    }

    public function selectProduct(): ProductInterfaceQueryObject
    {
        $object = new ProductInterfaceQueryObject('product');
        $this->selectField($object);

        return $object;
    }
}
