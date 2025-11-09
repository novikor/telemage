<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CompareListQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CompareList';

    public function selectAttributes(?CompareListAttributesArgumentsObject $argsObject = null): ComparableAttributeQueryObject
    {
        $object = new ComparableAttributeQueryObject('attributes');
        if ($argsObject instanceof CompareListAttributesArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectItemCount(): static
    {
        $this->selectField('item_count');

        return $this;
    }

    public function selectItems(?CompareListItemsArgumentsObject $argsObject = null): ComparableItemQueryObject
    {
        $object = new ComparableItemQueryObject('items');
        if ($argsObject instanceof CompareListItemsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUid(): static
    {
        $this->selectField('uid');

        return $this;
    }
}
