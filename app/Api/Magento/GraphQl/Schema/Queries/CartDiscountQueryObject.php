<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CartDiscountQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CartDiscount';

    public function selectAmount(?CartDiscountAmountArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('amount');
        if ($argsObject instanceof CartDiscountAmountArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLabel(): static
    {
        $this->selectField('label');

        return $this;
    }
}
