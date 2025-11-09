<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CustomerPaymentTokensQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CustomerPaymentTokens';

    public function selectItems(?CustomerPaymentTokensItemsArgumentsObject $argsObject = null): PaymentTokenQueryObject
    {
        $object = new PaymentTokenQueryObject('items');
        if ($argsObject instanceof CustomerPaymentTokensItemsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
