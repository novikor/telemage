<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class GiftMessageQueryObject extends QueryObject
{
    const OBJECT_NAME = 'GiftMessage';

    public function selectFrom(): static
    {
        $this->selectField('from');

        return $this;
    }

    public function selectMessage(): static
    {
        $this->selectField('message');

        return $this;
    }

    public function selectTo(): static
    {
        $this->selectField('to');

        return $this;
    }
}
