<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class OrderPaymentMethodQueryObject extends QueryObject
{
    const OBJECT_NAME = 'OrderPaymentMethod';

    public function selectAdditionalData(?OrderPaymentMethodAdditionalDataArgumentsObject $argsObject = null): KeyValueQueryObject
    {
        $object = new KeyValueQueryObject('additional_data');
        if ($argsObject instanceof OrderPaymentMethodAdditionalDataArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectName(): static
    {
        $this->selectField('name');

        return $this;
    }

    public function selectType(): static
    {
        $this->selectField('type');

        return $this;
    }
}
