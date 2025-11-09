<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class OrderCustomerInfoQueryObject extends QueryObject
{
    const OBJECT_NAME = 'OrderCustomerInfo';

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

    public function selectPrefix(): static
    {
        $this->selectField('prefix');

        return $this;
    }

    public function selectSuffix(): static
    {
        $this->selectField('suffix');

        return $this;
    }
}
