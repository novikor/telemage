<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CartQueryObject extends QueryObject
{
    const OBJECT_NAME = 'Cart';

    #[\Deprecated(message: 'Use `applied_coupons` instead.')]
    public function selectAppliedCoupon(?CartAppliedCouponArgumentsObject $argsObject = null): AppliedCouponQueryObject
    {
        $object = new AppliedCouponQueryObject('applied_coupon');
        if ($argsObject instanceof CartAppliedCouponArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAppliedCoupons(?CartAppliedCouponsArgumentsObject $argsObject = null): AppliedCouponQueryObject
    {
        $object = new AppliedCouponQueryObject('applied_coupons');
        if ($argsObject instanceof CartAppliedCouponsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAvailablePaymentMethods(?CartAvailablePaymentMethodsArgumentsObject $argsObject = null): AvailablePaymentMethodQueryObject
    {
        $object = new AvailablePaymentMethodQueryObject('available_payment_methods');
        if ($argsObject instanceof CartAvailablePaymentMethodsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBillingAddress(?CartBillingAddressArgumentsObject $argsObject = null): BillingCartAddressQueryObject
    {
        $object = new BillingCartAddressQueryObject('billing_address');
        if ($argsObject instanceof CartBillingAddressArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEmail(): static
    {
        $this->selectField('email');

        return $this;
    }

    public function selectGiftMessage(?CartGiftMessageArgumentsObject $argsObject = null): GiftMessageQueryObject
    {
        $object = new GiftMessageQueryObject('gift_message');
        if ($argsObject instanceof CartGiftMessageArgumentsObject) {
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

    public function selectIsVirtual(): static
    {
        $this->selectField('is_virtual');

        return $this;
    }

    public function selectItemsV2(?CartItemsV2ArgumentsObject $argsObject = null): CartItemsQueryObject
    {
        $object = new CartItemsQueryObject('itemsV2');
        if ($argsObject instanceof CartItemsV2ArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrices(?CartPricesArgumentsObject $argsObject = null): CartPricesQueryObject
    {
        $object = new CartPricesQueryObject('prices');
        if ($argsObject instanceof CartPricesArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSelectedPaymentMethod(?CartSelectedPaymentMethodArgumentsObject $argsObject = null): SelectedPaymentMethodQueryObject
    {
        $object = new SelectedPaymentMethodQueryObject('selected_payment_method');
        if ($argsObject instanceof CartSelectedPaymentMethodArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectShippingAddresses(?CartShippingAddressesArgumentsObject $argsObject = null): ShippingCartAddressQueryObject
    {
        $object = new ShippingCartAddressQueryObject('shipping_addresses');
        if ($argsObject instanceof CartShippingAddressesArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotalQuantity(): static
    {
        $this->selectField('total_quantity');

        return $this;
    }
}
