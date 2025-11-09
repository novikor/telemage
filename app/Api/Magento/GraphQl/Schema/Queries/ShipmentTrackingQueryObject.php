<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class ShipmentTrackingQueryObject extends QueryObject
{
    const OBJECT_NAME = 'ShipmentTracking';

    public function selectCarrier(): static
    {
        $this->selectField('carrier');

        return $this;
    }

    public function selectNumber(): static
    {
        $this->selectField('number');

        return $this;
    }

    public function selectTitle(): static
    {
        $this->selectField('title');

        return $this;
    }
}
