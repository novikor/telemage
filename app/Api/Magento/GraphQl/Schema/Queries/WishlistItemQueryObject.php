<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class WishlistItemQueryObject extends QueryObject
{
    const OBJECT_NAME = 'WishlistItem';

    public function selectAddedAt(): static
    {
        $this->selectField('added_at');

        return $this;
    }

    public function selectDescription(): static
    {
        $this->selectField('description');

        return $this;
    }

    public function selectId(): static
    {
        $this->selectField('id');

        return $this;
    }

    public function selectQty(): static
    {
        $this->selectField('qty');

        return $this;
    }
}
