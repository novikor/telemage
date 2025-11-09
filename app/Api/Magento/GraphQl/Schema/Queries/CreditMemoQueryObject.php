<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CreditMemoQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CreditMemo';

    public function selectComments(?CreditMemoCommentsArgumentsObject $argsObject = null): SalesCommentItemQueryObject
    {
        $object = new SalesCommentItemQueryObject('comments');
        if ($argsObject instanceof CreditMemoCommentsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId(): static
    {
        $this->selectField('id');

        return $this;
    }

    public function selectNumber(): static
    {
        $this->selectField('number');

        return $this;
    }

    public function selectTotal(?CreditMemoTotalArgumentsObject $argsObject = null): CreditMemoTotalQueryObject
    {
        $object = new CreditMemoTotalQueryObject('total');
        if ($argsObject instanceof CreditMemoTotalArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
