<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class WishlistItemsQueryObject extends QueryObject
{
    const OBJECT_NAME = 'WishlistItems';

    public function selectPageInfo(?WishlistItemsPageInfoArgumentsObject $argsObject = null): SearchResultPageInfoQueryObject
    {
        $object = new SearchResultPageInfoQueryObject('page_info');
        if ($argsObject instanceof WishlistItemsPageInfoArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
