<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class AvailableShippingMethodQueryObject extends QueryObject
{
    const OBJECT_NAME = 'AvailableShippingMethod';

    public function selectAmount(?AvailableShippingMethodAmountArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('amount');
        if ($argsObject instanceof AvailableShippingMethodAmountArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAvailable(): static
    {
        $this->selectField('available');

        return $this;
    }

    #[\Deprecated(message: 'The field should not be used on the storefront.')]
    public function selectBaseAmount(?AvailableShippingMethodBaseAmountArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('base_amount');
        if ($argsObject instanceof AvailableShippingMethodBaseAmountArgumentsObject) {
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

    public function selectErrorMessage(): static
    {
        $this->selectField('error_message');

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

    public function selectPriceExclTax(?AvailableShippingMethodPriceExclTaxArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('price_excl_tax');
        if ($argsObject instanceof AvailableShippingMethodPriceExclTaxArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPriceInclTax(?AvailableShippingMethodPriceInclTaxArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('price_incl_tax');
        if ($argsObject instanceof AvailableShippingMethodPriceInclTaxArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
