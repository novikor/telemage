<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class OrderTotalQueryObject extends QueryObject
{
    const OBJECT_NAME = 'OrderTotal';

    public function selectBaseGrandTotal(?OrderTotalBaseGrandTotalArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('base_grand_total');
        if ($argsObject instanceof OrderTotalBaseGrandTotalArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDiscounts(?OrderTotalDiscountsArgumentsObject $argsObject = null): DiscountQueryObject
    {
        $object = new DiscountQueryObject('discounts');
        if ($argsObject instanceof OrderTotalDiscountsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGrandTotal(?OrderTotalGrandTotalArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('grand_total');
        if ($argsObject instanceof OrderTotalGrandTotalArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectShippingHandling(?OrderTotalShippingHandlingArgumentsObject $argsObject = null): ShippingHandlingQueryObject
    {
        $object = new ShippingHandlingQueryObject('shipping_handling');
        if ($argsObject instanceof OrderTotalShippingHandlingArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    #[\Deprecated(message: 'Use subtotal_excl_tax field instead')]
    public function selectSubtotal(?OrderTotalSubtotalArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('subtotal');
        if ($argsObject instanceof OrderTotalSubtotalArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSubtotalExclTax(?OrderTotalSubtotalExclTaxArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('subtotal_excl_tax');
        if ($argsObject instanceof OrderTotalSubtotalExclTaxArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSubtotalInclTax(?OrderTotalSubtotalInclTaxArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('subtotal_incl_tax');
        if ($argsObject instanceof OrderTotalSubtotalInclTaxArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTaxes(?OrderTotalTaxesArgumentsObject $argsObject = null): TaxItemQueryObject
    {
        $object = new TaxItemQueryObject('taxes');
        if ($argsObject instanceof OrderTotalTaxesArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotalShipping(?OrderTotalTotalShippingArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('total_shipping');
        if ($argsObject instanceof OrderTotalTotalShippingArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotalTax(?OrderTotalTotalTaxArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('total_tax');
        if ($argsObject instanceof OrderTotalTotalTaxArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
