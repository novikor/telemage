<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class CustomerOrderQueryObject extends QueryObject
{
    const OBJECT_NAME = 'CustomerOrder';

    public function selectAppliedCoupons(?CustomerOrderAppliedCouponsArgumentsObject $argsObject = null): AppliedCouponQueryObject
    {
        $object = new AppliedCouponQueryObject('applied_coupons');
        if ($argsObject instanceof CustomerOrderAppliedCouponsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAvailableActions(): static
    {
        $this->selectField('available_actions');

        return $this;
    }

    public function selectBillingAddress(?CustomerOrderBillingAddressArgumentsObject $argsObject = null): OrderAddressQueryObject
    {
        $object = new OrderAddressQueryObject('billing_address');
        if ($argsObject instanceof CustomerOrderBillingAddressArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCarrier(): static
    {
        $this->selectField('carrier');

        return $this;
    }

    public function selectComments(?CustomerOrderCommentsArgumentsObject $argsObject = null): SalesCommentItemQueryObject
    {
        $object = new SalesCommentItemQueryObject('comments');
        if ($argsObject instanceof CustomerOrderCommentsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    #[\Deprecated(message: 'Use the `order_date` field instead.')]
    public function selectCreatedAt(): static
    {
        $this->selectField('created_at');

        return $this;
    }

    public function selectCreditMemos(?CustomerOrderCreditMemosArgumentsObject $argsObject = null): CreditMemoQueryObject
    {
        $object = new CreditMemoQueryObject('credit_memos');
        if ($argsObject instanceof CustomerOrderCreditMemosArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCustomerInfo(?CustomerOrderCustomerInfoArgumentsObject $argsObject = null): OrderCustomerInfoQueryObject
    {
        $object = new OrderCustomerInfoQueryObject('customer_info');
        if ($argsObject instanceof CustomerOrderCustomerInfoArgumentsObject) {
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

    public function selectGiftMessage(?CustomerOrderGiftMessageArgumentsObject $argsObject = null): GiftMessageQueryObject
    {
        $object = new GiftMessageQueryObject('gift_message');
        if ($argsObject instanceof CustomerOrderGiftMessageArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    #[\Deprecated(message: 'Use the `totals.grand_total` field instead.')]
    public function selectGrandTotal(): static
    {
        $this->selectField('grand_total');

        return $this;
    }

    public function selectId(): static
    {
        $this->selectField('id');

        return $this;
    }

    #[\Deprecated(message: 'Use the `id` field instead.')]
    public function selectIncrementId(): static
    {
        $this->selectField('increment_id');

        return $this;
    }

    public function selectInvoices(?CustomerOrderInvoicesArgumentsObject $argsObject = null): InvoiceQueryObject
    {
        $object = new InvoiceQueryObject('invoices');
        if ($argsObject instanceof CustomerOrderInvoicesArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIsVirtual(): static
    {
        $this->selectField('is_virtual');

        return $this;
    }

    public function selectNumber(): static
    {
        $this->selectField('number');

        return $this;
    }

    public function selectOrderDate(): static
    {
        $this->selectField('order_date');

        return $this;
    }

    #[\Deprecated(message: 'Use the `number` field instead.')]
    public function selectOrderNumber(): static
    {
        $this->selectField('order_number');

        return $this;
    }

    public function selectOrderStatusChangeDate(): static
    {
        $this->selectField('order_status_change_date');

        return $this;
    }

    public function selectPaymentMethods(?CustomerOrderPaymentMethodsArgumentsObject $argsObject = null): OrderPaymentMethodQueryObject
    {
        $object = new OrderPaymentMethodQueryObject('payment_methods');
        if ($argsObject instanceof CustomerOrderPaymentMethodsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectShipments(?CustomerOrderShipmentsArgumentsObject $argsObject = null): OrderShipmentQueryObject
    {
        $object = new OrderShipmentQueryObject('shipments');
        if ($argsObject instanceof CustomerOrderShipmentsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectShippingAddress(?CustomerOrderShippingAddressArgumentsObject $argsObject = null): OrderAddressQueryObject
    {
        $object = new OrderAddressQueryObject('shipping_address');
        if ($argsObject instanceof CustomerOrderShippingAddressArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectShippingMethod(): static
    {
        $this->selectField('shipping_method');

        return $this;
    }

    public function selectStatus(): static
    {
        $this->selectField('status');

        return $this;
    }

    public function selectToken(): static
    {
        $this->selectField('token');

        return $this;
    }

    public function selectTotal(?CustomerOrderTotalArgumentsObject $argsObject = null): OrderTotalQueryObject
    {
        $object = new OrderTotalQueryObject('total');
        if ($argsObject instanceof CustomerOrderTotalArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
