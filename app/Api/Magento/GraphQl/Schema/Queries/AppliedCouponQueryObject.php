<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class AppliedCouponQueryObject extends QueryObject
{
    const OBJECT_NAME = 'AppliedCoupon';

    public function selectCode(): static
    {
        $this->selectField('code');

        return $this;
    }
}
