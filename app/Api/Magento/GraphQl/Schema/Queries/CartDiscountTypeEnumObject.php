<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\EnumObject;

class CartDiscountTypeEnumObject extends EnumObject
{
    const ITEM = 'ITEM';

    const SHIPPING = 'SHIPPING';
}
