<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class SelectedPaymentMethodQueryObject extends QueryObject
{
    const OBJECT_NAME = 'SelectedPaymentMethod';

    public function selectCode(): static
    {
        $this->selectField('code');

        return $this;
    }

    public function selectPurchaseOrderNumber(): static
    {
        $this->selectField('purchase_order_number');

        return $this;
    }

    public function selectTitle(): static
    {
        $this->selectField('title');

        return $this;
    }
}
