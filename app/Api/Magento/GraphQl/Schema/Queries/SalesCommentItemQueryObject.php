<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class SalesCommentItemQueryObject extends QueryObject
{
    const OBJECT_NAME = 'SalesCommentItem';

    public function selectMessage(): static
    {
        $this->selectField('message');

        return $this;
    }

    public function selectTimestamp(): static
    {
        $this->selectField('timestamp');

        return $this;
    }
}
