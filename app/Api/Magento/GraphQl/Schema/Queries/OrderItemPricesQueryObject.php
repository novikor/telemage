<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class OrderItemPricesQueryObject extends QueryObject
{
    const OBJECT_NAME = 'OrderItemPrices';

    public function selectDiscounts(): DiscountQueryObject
    {
        $object = new DiscountQueryObject('discounts');
        $this->selectField($object);

        return $object;
    }

    public function selectFixedProductTaxes(): FixedProductTaxQueryObject
    {
        $object = new FixedProductTaxQueryObject('fixed_product_taxes');
        $this->selectField($object);

        return $object;
    }

    public function selectOriginalPrice(): MoneyQueryObject
    {
        $object = new MoneyQueryObject('original_price');
        $this->selectField($object);

        return $object;
    }

    public function selectOriginalPriceIncludingTax(): MoneyQueryObject
    {
        $object = new MoneyQueryObject('original_price_including_tax');
        $this->selectField($object);

        return $object;
    }

    public function selectOriginalRowTotal(): MoneyQueryObject
    {
        $object = new MoneyQueryObject('original_row_total');
        $this->selectField($object);

        return $object;
    }

    public function selectOriginalRowTotalIncludingTax(): MoneyQueryObject
    {
        $object = new MoneyQueryObject('original_row_total_including_tax');
        $this->selectField($object);

        return $object;
    }

    public function selectPrice(): MoneyQueryObject
    {
        $object = new MoneyQueryObject('price');
        $this->selectField($object);

        return $object;
    }

    public function selectPriceIncludingTax(): MoneyQueryObject
    {
        $object = new MoneyQueryObject('price_including_tax');
        $this->selectField($object);

        return $object;
    }

    public function selectRowTotal(): MoneyQueryObject
    {
        $object = new MoneyQueryObject('row_total');
        $this->selectField($object);

        return $object;
    }

    public function selectRowTotalIncludingTax(): MoneyQueryObject
    {
        $object = new MoneyQueryObject('row_total_including_tax');
        $this->selectField($object);

        return $object;
    }

    public function selectTotalItemDiscount(): MoneyQueryObject
    {
        $object = new MoneyQueryObject('total_item_discount');
        $this->selectField($object);

        return $object;
    }
}
