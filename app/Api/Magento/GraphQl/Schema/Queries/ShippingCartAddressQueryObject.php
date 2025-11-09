<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class ShippingCartAddressQueryObject extends QueryObject
{
    const OBJECT_NAME = 'ShippingCartAddress';

    public function selectAvailableShippingMethods(?ShippingCartAddressAvailableShippingMethodsArgumentsObject $argsObject = null): AvailableShippingMethodQueryObject
    {
        $object = new AvailableShippingMethodQueryObject('available_shipping_methods');
        if ($argsObject instanceof ShippingCartAddressAvailableShippingMethodsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    #[\Deprecated(message: 'Use `cart_items_v2` instead.')]
    public function selectCartItems(?ShippingCartAddressCartItemsArgumentsObject $argsObject = null): CartItemQuantityQueryObject
    {
        $object = new CartItemQuantityQueryObject('cart_items');
        if ($argsObject instanceof ShippingCartAddressCartItemsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCity(): static
    {
        $this->selectField('city');

        return $this;
    }

    public function selectCompany(): static
    {
        $this->selectField('company');

        return $this;
    }

    public function selectCountry(?ShippingCartAddressCountryArgumentsObject $argsObject = null): CartAddressCountryQueryObject
    {
        $object = new CartAddressCountryQueryObject('country');
        if ($argsObject instanceof ShippingCartAddressCountryArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCustomerNotes(): static
    {
        $this->selectField('customer_notes');

        return $this;
    }

    public function selectFax(): static
    {
        $this->selectField('fax');

        return $this;
    }

    public function selectFirstname(): static
    {
        $this->selectField('firstname');

        return $this;
    }

    public function selectId(): static
    {
        $this->selectField('id');

        return $this;
    }

    #[\Deprecated(message: 'This information should not be exposed on the frontend.')]
    public function selectItemsWeight(): static
    {
        $this->selectField('items_weight');

        return $this;
    }

    public function selectLastname(): static
    {
        $this->selectField('lastname');

        return $this;
    }

    public function selectMiddlename(): static
    {
        $this->selectField('middlename');

        return $this;
    }

    public function selectPickupLocationCode(): static
    {
        $this->selectField('pickup_location_code');

        return $this;
    }

    public function selectPostcode(): static
    {
        $this->selectField('postcode');

        return $this;
    }

    public function selectPrefix(): static
    {
        $this->selectField('prefix');

        return $this;
    }

    public function selectRegion(?ShippingCartAddressRegionArgumentsObject $argsObject = null): CartAddressRegionQueryObject
    {
        $object = new CartAddressRegionQueryObject('region');
        if ($argsObject instanceof ShippingCartAddressRegionArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSameAsBilling(): static
    {
        $this->selectField('same_as_billing');

        return $this;
    }

    public function selectSelectedShippingMethod(?ShippingCartAddressSelectedShippingMethodArgumentsObject $argsObject = null): SelectedShippingMethodQueryObject
    {
        $object = new SelectedShippingMethodQueryObject('selected_shipping_method');
        if ($argsObject instanceof ShippingCartAddressSelectedShippingMethodArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStreet(): static
    {
        $this->selectField('street');

        return $this;
    }

    public function selectSuffix(): static
    {
        $this->selectField('suffix');

        return $this;
    }

    public function selectTelephone(): static
    {
        $this->selectField('telephone');

        return $this;
    }

    public function selectUid(): static
    {
        $this->selectField('uid');

        return $this;
    }

    public function selectVatId(): static
    {
        $this->selectField('vat_id');

        return $this;
    }
}
