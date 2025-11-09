<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CartAddressRegionQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CartAddressRegion';

    public function selectCode(): static
    {
        $this->selectField('code');

        return $this;
    }

    public function selectLabel(): static
    {
        $this->selectField('label');

        return $this;
    }

    public function selectRegionId(): static
    {
        $this->selectField('region_id');

        return $this;
    }
}
