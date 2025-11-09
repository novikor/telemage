<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CustomerDownloadableProductsQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CustomerDownloadableProducts';

    public function selectItems(?CustomerDownloadableProductsItemsArgumentsObject $argsObject = null): CustomerDownloadableProductQueryObject
    {
        $object = new CustomerDownloadableProductQueryObject('items');
        if ($argsObject instanceof CustomerDownloadableProductsItemsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
