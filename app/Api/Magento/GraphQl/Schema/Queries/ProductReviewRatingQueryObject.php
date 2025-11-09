<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class ProductReviewRatingQueryObject extends QueryObject
{
    const OBJECT_NAME = 'ProductReviewRating';

    public function selectName(): static
    {
        $this->selectField('name');

        return $this;
    }

    public function selectValue(): static
    {
        $this->selectField('value');

        return $this;
    }
}
