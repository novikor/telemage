<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

enum SortDirectionEnum: string
{
    case ASC = 'ASC';

    case DESC = 'DESC';
}
