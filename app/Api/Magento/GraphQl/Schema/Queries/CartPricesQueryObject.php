<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CartPricesQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CartPrices';

    public function selectAppliedTaxes(?CartPricesAppliedTaxesArgumentsObject $argsObject = null): CartTaxItemQueryObject
    {
        $object = new CartTaxItemQueryObject('applied_taxes');
        if ($argsObject instanceof CartPricesAppliedTaxesArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    #[\Deprecated(message: 'Use discounts instead.')]
    public function selectDiscount(?CartPricesDiscountArgumentsObject $argsObject = null): CartDiscountQueryObject
    {
        $object = new CartDiscountQueryObject('discount');
        if ($argsObject instanceof CartPricesDiscountArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDiscounts(?CartPricesDiscountsArgumentsObject $argsObject = null): DiscountQueryObject
    {
        $object = new DiscountQueryObject('discounts');
        if ($argsObject instanceof CartPricesDiscountsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGrandTotal(?CartPricesGrandTotalArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('grand_total');
        if ($argsObject instanceof CartPricesGrandTotalArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGrandTotalExcludingTax(?CartPricesGrandTotalExcludingTaxArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('grand_total_excluding_tax');
        if ($argsObject instanceof CartPricesGrandTotalExcludingTaxArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSubtotalExcludingTax(?CartPricesSubtotalExcludingTaxArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('subtotal_excluding_tax');
        if ($argsObject instanceof CartPricesSubtotalExcludingTaxArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSubtotalIncludingTax(?CartPricesSubtotalIncludingTaxArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('subtotal_including_tax');
        if ($argsObject instanceof CartPricesSubtotalIncludingTaxArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSubtotalWithDiscountExcludingTax(?CartPricesSubtotalWithDiscountExcludingTaxArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('subtotal_with_discount_excluding_tax');
        if ($argsObject instanceof CartPricesSubtotalWithDiscountExcludingTaxArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
