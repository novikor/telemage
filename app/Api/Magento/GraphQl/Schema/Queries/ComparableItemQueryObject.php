<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class ComparableItemQueryObject extends QueryObject
{
    const OBJECT_NAME = 'ComparableItem';

    public function selectAttributes(?ComparableItemAttributesArgumentsObject $argsObject = null): ProductAttributeQueryObject
    {
        $object = new ProductAttributeQueryObject('attributes');
        if ($argsObject instanceof ComparableItemAttributesArgumentsObject) {
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
