<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CreditMemoTotalQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CreditMemoTotal';

    public function selectAdjustment(?CreditMemoTotalAdjustmentArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('adjustment');
        if ($argsObject instanceof CreditMemoTotalAdjustmentArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBaseGrandTotal(?CreditMemoTotalBaseGrandTotalArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('base_grand_total');
        if ($argsObject instanceof CreditMemoTotalBaseGrandTotalArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDiscounts(?CreditMemoTotalDiscountsArgumentsObject $argsObject = null): DiscountQueryObject
    {
        $object = new DiscountQueryObject('discounts');
        if ($argsObject instanceof CreditMemoTotalDiscountsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGrandTotal(?CreditMemoTotalGrandTotalArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('grand_total');
        if ($argsObject instanceof CreditMemoTotalGrandTotalArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectShippingHandling(?CreditMemoTotalShippingHandlingArgumentsObject $argsObject = null): ShippingHandlingQueryObject
    {
        $object = new ShippingHandlingQueryObject('shipping_handling');
        if ($argsObject instanceof CreditMemoTotalShippingHandlingArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSubtotal(?CreditMemoTotalSubtotalArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('subtotal');
        if ($argsObject instanceof CreditMemoTotalSubtotalArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTaxes(?CreditMemoTotalTaxesArgumentsObject $argsObject = null): TaxItemQueryObject
    {
        $object = new TaxItemQueryObject('taxes');
        if ($argsObject instanceof CreditMemoTotalTaxesArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotalShipping(?CreditMemoTotalTotalShippingArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('total_shipping');
        if ($argsObject instanceof CreditMemoTotalTotalShippingArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotalTax(?CreditMemoTotalTotalTaxArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('total_tax');
        if ($argsObject instanceof CreditMemoTotalTotalTaxArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
