<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CartItemsQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CartItems';

    public function selectPageInfo(?CartItemsPageInfoArgumentsObject $argsObject = null): SearchResultPageInfoQueryObject
    {
        $object = new SearchResultPageInfoQueryObject('page_info');
        if ($argsObject instanceof CartItemsPageInfoArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotalCount(): static
    {
        $this->selectField('total_count');

        return $this;
    }
}
