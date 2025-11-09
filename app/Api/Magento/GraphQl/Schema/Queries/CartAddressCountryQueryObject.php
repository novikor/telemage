<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CartAddressCountryQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CartAddressCountry';

    public function selectCode(): static
    {
        $this->selectField('code');

        return $this;
    }

    public function selectLabel(): static
    {
        $this->selectField('label');

        return $this;
    }
}
