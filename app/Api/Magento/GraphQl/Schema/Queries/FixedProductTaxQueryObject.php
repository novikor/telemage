<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class FixedProductTaxQueryObject extends QueryObject
{
    const OBJECT_NAME = 'FixedProductTax';

    public function selectAmount(): MoneyQueryObject
    {
        $object = new MoneyQueryObject('amount');
        $this->selectField($object);

        return $object;
    }

    public function selectLabel(): self
    {
        $this->selectField('label');

        return $this;
    }
}
