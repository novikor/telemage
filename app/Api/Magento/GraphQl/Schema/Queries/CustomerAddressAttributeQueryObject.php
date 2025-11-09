<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CustomerAddressAttributeQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CustomerAddressAttribute';

    public function selectAttributeCode(): static
    {
        $this->selectField('attribute_code');

        return $this;
    }

    public function selectValue(): static
    {
        $this->selectField('value');

        return $this;
    }
}
