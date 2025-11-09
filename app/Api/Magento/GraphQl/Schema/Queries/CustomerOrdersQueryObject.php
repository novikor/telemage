<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CustomerOrdersQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CustomerOrders';

    public function selectDateOfFirstOrder(): static
    {
        $this->selectField('date_of_first_order');

        return $this;
    }

    public function selectItems(?CustomerOrdersItemsArgumentsObject $argsObject = null): CustomerOrderQueryObject
    {
        $object = new CustomerOrderQueryObject('items');
        if ($argsObject instanceof CustomerOrdersItemsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(?CustomerOrdersPageInfoArgumentsObject $argsObject = null): SearchResultPageInfoQueryObject
    {
        $object = new SearchResultPageInfoQueryObject('page_info');
        if ($argsObject instanceof CustomerOrdersPageInfoArgumentsObject) {
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
