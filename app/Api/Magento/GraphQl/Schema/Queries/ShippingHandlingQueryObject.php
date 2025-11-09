<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class ShippingHandlingQueryObject extends QueryObject
{
    const OBJECT_NAME = 'ShippingHandling';

    public function selectAmountExcludingTax(?ShippingHandlingAmountExcludingTaxArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('amount_excluding_tax');
        if ($argsObject instanceof ShippingHandlingAmountExcludingTaxArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAmountIncludingTax(?ShippingHandlingAmountIncludingTaxArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('amount_including_tax');
        if ($argsObject instanceof ShippingHandlingAmountIncludingTaxArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDiscounts(?ShippingHandlingDiscountsArgumentsObject $argsObject = null): ShippingDiscountQueryObject
    {
        $object = new ShippingDiscountQueryObject('discounts');
        if ($argsObject instanceof ShippingHandlingDiscountsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTaxes(?ShippingHandlingTaxesArgumentsObject $argsObject = null): TaxItemQueryObject
    {
        $object = new TaxItemQueryObject('taxes');
        if ($argsObject instanceof ShippingHandlingTaxesArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotalAmount(?ShippingHandlingTotalAmountArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('total_amount');
        if ($argsObject instanceof ShippingHandlingTotalAmountArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
