<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\EnumObject;

class CustomerOrderSortableFieldEnumObject extends EnumObject
{
    const NUMBER = 'NUMBER';

    const CREATED_AT = 'CREATED_AT';
}
