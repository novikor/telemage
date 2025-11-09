<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\EnumObject;

class ConfirmationStatusEnumEnumObject extends EnumObject
{
    const ACCOUNT_CONFIRMED = 'ACCOUNT_CONFIRMED';

    const ACCOUNT_CONFIRMATION_NOT_REQUIRED = 'ACCOUNT_CONFIRMATION_NOT_REQUIRED';
}
