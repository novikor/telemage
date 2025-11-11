<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

enum CustomerOrderSortableFieldEnum: string
{
    case NUMBER = 'NUMBER';

    case CREATED_AT = 'CREATED_AT';
}
