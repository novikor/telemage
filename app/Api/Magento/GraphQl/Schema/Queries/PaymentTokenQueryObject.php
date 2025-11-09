<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class PaymentTokenQueryObject extends QueryObject
{
    const OBJECT_NAME = 'PaymentToken';

    public function selectDetails(): static
    {
        $this->selectField('details');

        return $this;
    }

    public function selectPaymentMethodCode(): static
    {
        $this->selectField('payment_method_code');

        return $this;
    }

    public function selectPublicHash(): static
    {
        $this->selectField('public_hash');

        return $this;
    }

    public function selectType(): static
    {
        $this->selectField('type');

        return $this;
    }
}
