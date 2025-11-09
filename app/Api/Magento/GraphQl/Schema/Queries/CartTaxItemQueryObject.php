<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CartTaxItemQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CartTaxItem';

    public function selectAmount(?CartTaxItemAmountArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('amount');
        if ($argsObject instanceof CartTaxItemAmountArgumentsObject) {
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
