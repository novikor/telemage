<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class ComparableAttributeQueryObject extends QueryObject
{
    const OBJECT_NAME = 'ComparableAttribute';

    public function selectCode(): static
    {
        $this->selectField('code');

        return $this;
    }

    public function selectLabel(): static
    {
        $this->selectField('label');

        return $this;
    }
}
