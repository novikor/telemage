<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CustomerAddressesQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CustomerAddresses';

    public function selectItems(?CustomerAddressesItemsArgumentsObject $argsObject = null): CustomerAddressQueryObject
    {
        $object = new CustomerAddressQueryObject('items');
        if ($argsObject instanceof CustomerAddressesItemsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(?CustomerAddressesPageInfoArgumentsObject $argsObject = null): SearchResultPageInfoQueryObject
    {
        $object = new SearchResultPageInfoQueryObject('page_info');
        if ($argsObject instanceof CustomerAddressesPageInfoArgumentsObject) {
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
