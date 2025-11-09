<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\EnumObject;

class OrderActionTypeEnumObject extends EnumObject
{
    const CANCEL = 'CANCEL';

    const REORDER = 'REORDER';
}
