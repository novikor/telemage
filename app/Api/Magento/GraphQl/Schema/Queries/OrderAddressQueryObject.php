<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class OrderAddressQueryObject extends QueryObject
{
    const OBJECT_NAME = 'OrderAddress';

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

    public function selectRegion(): static
    {
        $this->selectField('region');

        return $this;
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
