<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class TaxItemQueryObject extends QueryObject
{
    const OBJECT_NAME = 'TaxItem';

    public function selectAmount(?TaxItemAmountArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('amount');
        if ($argsObject instanceof TaxItemAmountArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRate(): static
    {
        $this->selectField('rate');

        return $this;
    }

    public function selectTitle(): static
    {
        $this->selectField('title');

        return $this;
    }
}
