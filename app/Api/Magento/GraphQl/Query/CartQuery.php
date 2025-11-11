<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Query;

use App\Api\Magento\GraphQl\Schema\Queries\CartQueryObject;

class CartQuery
{
    public static function applySelection(CartQueryObject $cartQuery): void
    {
        $cartQuery->selectId();
        $cartQuery->selectEmail();
        $cartQuery->selectIsVirtual();
        $cartQuery->selectTotalQuantity();
        $cartQuery->selectTotalQuantity();

        $cartQuery->selectAvailablePaymentMethods()
            ->selectCode()
            ->selectTitle();

        $cartQuery->selectSelectedPaymentMethod()
            ->selectCode()
            ->selectTitle();

        $cartQuery->selectItemsV2()
            ->selectItems()
            ->selectUid()
            ->selectQuantity()
            ->selectProduct()
            ->selectUid()
            ->selectName()
            ->selectSku();

        $cartQuery->selectPrices()
            ->selectGrandTotal()
            ->selectValue()
            ->selectCurrency();

        $cartQuery->selectBillingAddress()
            ->selectFirstname()
            ->selectLastname()
            ->selectStreet()
            ->selectCity()
            ->selectPostcode()
            ->selectCountry()
            ->selectCode()
            ->selectLabel();

        $shippingAddresses = $cartQuery->selectShippingAddresses();
        $shippingAddresses->selectFirstname();
        $shippingAddresses->selectLastname();
        $shippingAddresses->selectStreet();
        $shippingAddresses->selectCity();
        $shippingAddresses->selectPostcode();
        $shippingAddresses->selectCountry()
            ->selectCode()
            ->selectLabel();
        $shippingAddresses->selectAvailableShippingMethods()
            ->selectCarrierCode()
            ->selectCarrierTitle()
            ->selectMethodCode()
            ->selectMethodTitle()
            ->selectAmount()
            ->selectValue()
            ->selectCurrency();
        $shippingAddresses->selectSelectedShippingMethod()
            ->selectCarrierCode()
            ->selectCarrierTitle()
            ->selectMethodCode()
            ->selectMethodTitle()
            ->selectAmount()
            ->selectValue()
            ->selectCurrency();
    }
}
