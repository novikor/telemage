<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class InvoiceQueryObject extends QueryObject
{
    const OBJECT_NAME = 'Invoice';

    public function selectComments(?InvoiceCommentsArgumentsObject $argsObject = null): SalesCommentItemQueryObject
    {
        $object = new SalesCommentItemQueryObject('comments');
        if ($argsObject instanceof InvoiceCommentsArgumentsObject) {
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

    public function selectTotal(?InvoiceTotalArgumentsObject $argsObject = null): InvoiceTotalQueryObject
    {
        $object = new InvoiceTotalQueryObject('total');
        if ($argsObject instanceof InvoiceTotalArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
