<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class RootQueryObject extends QueryObject
{
    const string OBJECT_NAME = '';

    public function selectCart(?RootCartArgumentsObject $argsObject = null): CartQueryObject
    {
        $object = new CartQueryObject('cart');
        if ($argsObject instanceof RootCartArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCustomer(?RootCustomerArgumentsObject $argsObject = null): CustomerQueryObject
    {
        $object = new CustomerQueryObject('customer');
        if ($argsObject instanceof RootCustomerArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCustomerCart(?RootCustomerCartArgumentsObject $argsObject = null): CartQueryObject
    {
        $object = new CartQueryObject('customerCart');
        if ($argsObject instanceof RootCustomerCartArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCustomerDownloadableProducts(?RootCustomerDownloadableProductsArgumentsObject $argsObject = null): CustomerDownloadableProductsQueryObject
    {
        $object = new CustomerDownloadableProductsQueryObject('customerDownloadableProducts');
        if ($argsObject instanceof RootCustomerDownloadableProductsArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    #[\Deprecated(message: 'Use the `customer` query instead.')]
    /**
     * @deprecated
     */
    public function selectCustomerOrders(?RootCustomerOrdersArgumentsObject $argsObject = null): CustomerOrdersQueryObject
    {
        $object = new CustomerOrdersQueryObject('customerOrders');
        if ($argsObject instanceof RootCustomerOrdersArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCustomerPaymentTokens(?RootCustomerPaymentTokensArgumentsObject $argsObject = null): CustomerPaymentTokensQueryObject
    {
        $object = new CustomerPaymentTokensQueryObject('customerPaymentTokens');
        if ($argsObject instanceof RootCustomerPaymentTokensArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGetPaymentOrder(?RootGetPaymentOrderArgumentsObject $argsObject = null): PaymentOrderOutputQueryObject
    {
        $object = new PaymentOrderOutputQueryObject('getPaymentOrder');
        if ($argsObject instanceof RootGetPaymentOrderArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGuestOrder(?RootGuestOrderArgumentsObject $argsObject = null): CustomerOrderQueryObject
    {
        $object = new CustomerOrderQueryObject('guestOrder');
        if ($argsObject instanceof RootGuestOrderArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGuestOrderByToken(?RootGuestOrderByTokenArgumentsObject $argsObject = null): CustomerOrderQueryObject
    {
        $object = new CustomerOrderQueryObject('guestOrderByToken');
        if ($argsObject instanceof RootGuestOrderByTokenArgumentsObject) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
