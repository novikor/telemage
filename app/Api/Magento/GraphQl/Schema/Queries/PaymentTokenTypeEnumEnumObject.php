<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\EnumObject;

class PaymentTokenTypeEnumEnumObject extends EnumObject
{
    const CARD = 'card';

    const ACCOUNT = 'account';
}
