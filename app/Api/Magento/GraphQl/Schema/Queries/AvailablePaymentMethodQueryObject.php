<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class AvailablePaymentMethodQueryObject extends QueryObject
{
    const OBJECT_NAME = 'AvailablePaymentMethod';

    public function selectCode(): static
    {
        $this->selectField('code');

        return $this;
    }

    public function selectIsDeferred(): static
    {
        $this->selectField('is_deferred');

        return $this;
    }

    public function selectTitle(): static
    {
        $this->selectField('title');

        return $this;
    }
}
