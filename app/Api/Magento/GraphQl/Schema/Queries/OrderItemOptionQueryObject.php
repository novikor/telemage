<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class OrderItemOptionQueryObject extends QueryObject
{
    const OBJECT_NAME = 'OrderItemOption';

    public function selectLabel(): self
    {
        $this->selectField('label');

        return $this;
    }

    public function selectValue(): self
    {
        $this->selectField('value');

        return $this;
    }
}
