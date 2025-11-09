<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CustomerAddressRegionQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CustomerAddressRegion';

    public function selectRegion(): static
    {
        $this->selectField('region');

        return $this;
    }

    public function selectRegionCode(): static
    {
        $this->selectField('region_code');

        return $this;
    }

    public function selectRegionId(): static
    {
        $this->selectField('region_id');

        return $this;
    }
}
