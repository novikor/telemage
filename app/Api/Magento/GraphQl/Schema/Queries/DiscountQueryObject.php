<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class DiscountQueryObject extends QueryObject
{
    const OBJECT_NAME = 'Discount';

    public function selectAmount(?DiscountAmountArgumentsObject $argsObject = null): MoneyQueryObject
    {
        $object = new MoneyQueryObject('amount');
        if ($argsObject instanceof DiscountAmountArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAppliedTo(): static
    {
        $this->selectField('applied_to');

        return $this;
    }

    public function selectCoupon(?DiscountCouponArgumentsObject $argsObject = null): AppliedCouponQueryObject
    {
        $object = new AppliedCouponQueryObject('coupon');
        if ($argsObject instanceof DiscountCouponArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLabel(): static
    {
        $this->selectField('label');

        return $this;
    }
}
