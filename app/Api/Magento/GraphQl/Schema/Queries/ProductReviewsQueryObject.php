<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class ProductReviewsQueryObject extends QueryObject
{
    const OBJECT_NAME = 'ProductReviews';

    public function selectItems(?ProductReviewsItemsArgumentsObject $argsObject = null): ProductReviewQueryObject
    {
        $object = new ProductReviewQueryObject('items');
        if ($argsObject instanceof ProductReviewsItemsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(?ProductReviewsPageInfoArgumentsObject $argsObject = null): SearchResultPageInfoQueryObject
    {
        $object = new SearchResultPageInfoQueryObject('page_info');
        if ($argsObject instanceof ProductReviewsPageInfoArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
