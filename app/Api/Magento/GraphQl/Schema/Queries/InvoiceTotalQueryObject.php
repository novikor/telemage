<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class InvoiceTotalQueryObject extends QueryObject
{
    const OBJECT_NAME = 'InvoiceTotal';

    public function selectBaseGrandTotal(?InvoiceTotalBaseGrandTotalArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('base_grand_total');
        if ($argsObject instanceof InvoiceTotalBaseGrandTotalArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDiscounts(?InvoiceTotalDiscountsArgumentsObject $argsObject = null): DiscountQueryObject
    {
        $object = new DiscountQueryObject('discounts');
        if ($argsObject instanceof InvoiceTotalDiscountsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGrandTotal(?InvoiceTotalGrandTotalArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('grand_total');
        if ($argsObject instanceof InvoiceTotalGrandTotalArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectShippingHandling(?InvoiceTotalShippingHandlingArgumentsObject $argsObject = null): ShippingHandlingQueryObject
    {
        $object = new ShippingHandlingQueryObject('shipping_handling');
        if ($argsObject instanceof InvoiceTotalShippingHandlingArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSubtotal(?InvoiceTotalSubtotalArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('subtotal');
        if ($argsObject instanceof InvoiceTotalSubtotalArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTaxes(?InvoiceTotalTaxesArgumentsObject $argsObject = null): TaxItemQueryObject
    {
        $object = new TaxItemQueryObject('taxes');
        if ($argsObject instanceof InvoiceTotalTaxesArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotalShipping(?InvoiceTotalTotalShippingArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('total_shipping');
        if ($argsObject instanceof InvoiceTotalTotalShippingArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotalTax(?InvoiceTotalTotalTaxArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('total_tax');
        if ($argsObject instanceof InvoiceTotalTotalTaxArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
