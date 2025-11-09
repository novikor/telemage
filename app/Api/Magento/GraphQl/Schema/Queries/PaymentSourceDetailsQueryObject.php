<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class PaymentSourceDetailsQueryObject extends QueryObject
{
    const OBJECT_NAME = 'PaymentSourceDetails';

    public function selectCard(?PaymentSourceDetailsCardArgumentsObject $argsObject = null): CardQueryObject
    {
        $object = new CardQueryObject('card');
        if ($argsObject instanceof PaymentSourceDetailsCardArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
