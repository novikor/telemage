<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class PaymentOrderOutputQueryObject extends QueryObject
{
    const OBJECT_NAME = 'PaymentOrderOutput';

    public function selectId(): static
    {
        $this->selectField('id');

        return $this;
    }

    public function selectMpOrderId(): static
    {
        $this->selectField('mp_order_id');

        return $this;
    }

    public function selectPaymentSourceDetails(?PaymentOrderOutputPaymentSourceDetailsArgumentsObject $argsObject = null): PaymentSourceDetailsQueryObject
    {
        $object = new PaymentSourceDetailsQueryObject('payment_source_details');
        if ($argsObject instanceof PaymentOrderOutputPaymentSourceDetailsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStatus(): static
    {
        $this->selectField('status');

        return $this;
    }
}
