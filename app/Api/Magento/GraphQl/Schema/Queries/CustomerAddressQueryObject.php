<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CustomerAddressQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CustomerAddress';

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

    public function selectCountryCode(): static
    {
        $this->selectField('country_code');

        return $this;
    }

    #[\Deprecated(message: 'Use `country_code` instead.')]
    public function selectCountryId(): static
    {
        $this->selectField('country_id');

        return $this;
    }

    #[\Deprecated(message: 'Use custom_attributesV2 instead.')]
    public function selectCustomAttributes(?CustomerAddressCustomAttributesArgumentsObject $argsObject = null): CustomerAddressAttributeQueryObject
    {
        $object = new CustomerAddressAttributeQueryObject('custom_attributes');
        if ($argsObject instanceof CustomerAddressCustomAttributesArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    #[\Deprecated(message: '`customer_id` is not needed as part of `CustomerAddress`. The `id` is a unique identifier for the addresses.')]
    public function selectCustomerId(): static
    {
        $this->selectField('customer_id');

        return $this;
    }

    public function selectDefaultBilling(): static
    {
        $this->selectField('default_billing');

        return $this;
    }

    public function selectDefaultShipping(): static
    {
        $this->selectField('default_shipping');

        return $this;
    }

    public function selectExtensionAttributes(?CustomerAddressExtensionAttributesArgumentsObject $argsObject = null): CustomerAddressAttributeQueryObject
    {
        $object = new CustomerAddressAttributeQueryObject('extension_attributes');
        if ($argsObject instanceof CustomerAddressExtensionAttributesArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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

    public function selectRegion(?CustomerAddressRegionArgumentsObject $argsObject = null): CustomerAddressRegionQueryObject
    {
        $object = new CustomerAddressRegionQueryObject('region');
        if ($argsObject instanceof CustomerAddressRegionArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRegionId(): static
    {
        $this->selectField('region_id');

        return $this;
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

    public function selectVatId(): static
    {
        $this->selectField('vat_id');

        return $this;
    }
}
