<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class ProductReviewQueryObject extends QueryObject
{
    const OBJECT_NAME = 'ProductReview';

    public function selectAverageRating(): static
    {
        $this->selectField('average_rating');

        return $this;
    }

    public function selectCreatedAt(): static
    {
        $this->selectField('created_at');

        return $this;
    }

    public function selectNickname(): static
    {
        $this->selectField('nickname');

        return $this;
    }

    public function selectRatingsBreakdown(?ProductReviewRatingsBreakdownArgumentsObject $argsObject = null): ProductReviewRatingQueryObject
    {
        $object = new ProductReviewRatingQueryObject('ratings_breakdown');
        if ($argsObject instanceof ProductReviewRatingsBreakdownArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSummary(): static
    {
        $this->selectField('summary');

        return $this;
    }

    public function selectText(): static
    {
        $this->selectField('text');

        return $this;
    }
}
