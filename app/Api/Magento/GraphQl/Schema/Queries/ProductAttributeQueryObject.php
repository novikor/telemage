<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class ProductAttributeQueryObject extends QueryObject
{
    const OBJECT_NAME = 'ProductAttribute';

    public function selectCode(): static
    {
        $this->selectField('code');

        return $this;
    }

    public function selectValue(): static
    {
        $this->selectField('value');

        return $this;
    }
}
