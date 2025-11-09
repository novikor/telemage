<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class SelectedShippingMethodQueryObject extends QueryObject
{
    const OBJECT_NAME = 'SelectedShippingMethod';

    public function selectAmount(?SelectedShippingMethodAmountArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('amount');
        if ($argsObject instanceof SelectedShippingMethodAmountArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    #[\Deprecated(message: 'The field should not be used on the storefront.')]
    public function selectBaseAmount(?SelectedShippingMethodBaseAmountArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('base_amount');
        if ($argsObject instanceof SelectedShippingMethodBaseAmountArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCarrierCode(): static
    {
        $this->selectField('carrier_code');

        return $this;
    }

    public function selectCarrierTitle(): static
    {
        $this->selectField('carrier_title');

        return $this;
    }

    public function selectMethodCode(): static
    {
        $this->selectField('method_code');

        return $this;
    }

    public function selectMethodTitle(): static
    {
        $this->selectField('method_title');

        return $this;
    }

    public function selectPriceExclTax(?SelectedShippingMethodPriceExclTaxArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('price_excl_tax');
        if ($argsObject instanceof SelectedShippingMethodPriceExclTaxArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPriceInclTax(?SelectedShippingMethodPriceInclTaxArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('price_incl_tax');
        if ($argsObject instanceof SelectedShippingMethodPriceInclTaxArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
