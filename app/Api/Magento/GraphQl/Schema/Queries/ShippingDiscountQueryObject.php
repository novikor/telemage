<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class ShippingDiscountQueryObject extends QueryObject
{
    const OBJECT_NAME = 'ShippingDiscount';

    public function selectAmount(?ShippingDiscountAmountArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('amount');
        if ($argsObject instanceof ShippingDiscountAmountArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
