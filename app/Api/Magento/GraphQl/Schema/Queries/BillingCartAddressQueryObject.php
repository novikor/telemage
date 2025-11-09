<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class BillingCartAddressQueryObject extends QueryObject
{
    const OBJECT_NAME = 'BillingCartAddress';

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

    public function selectCountry(?BillingCartAddressCountryArgumentsObject $argsObject = null): CartAddressCountryQueryObject
    {
        $object = new CartAddressCountryQueryObject('country');
        if ($argsObject instanceof BillingCartAddressCountryArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    #[\Deprecated(message: 'The field is used only in shipping address.')]
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

    public function selectRegion(?BillingCartAddressRegionArgumentsObject $argsObject = null): CartAddressRegionQueryObject
    {
        $object = new CartAddressRegionQueryObject('region');
        if ($argsObject instanceof BillingCartAddressRegionArgumentsObject) {
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
