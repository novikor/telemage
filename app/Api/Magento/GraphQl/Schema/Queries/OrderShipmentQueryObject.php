<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class OrderShipmentQueryObject extends QueryObject
{
    const OBJECT_NAME = 'OrderShipment';

    public function selectComments(?OrderShipmentCommentsArgumentsObject $argsObject = null): SalesCommentItemQueryObject
    {
        $object = new SalesCommentItemQueryObject('comments');
        if ($argsObject instanceof OrderShipmentCommentsArgumentsObject) {
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

    public function selectTracking(?OrderShipmentTrackingArgumentsObject $argsObject = null): ShipmentTrackingQueryObject
    {
        $object = new ShipmentTrackingQueryObject('tracking');
        if ($argsObject instanceof OrderShipmentTrackingArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
