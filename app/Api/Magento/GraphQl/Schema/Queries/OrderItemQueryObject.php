<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\QueryObject;

class OrderItemQueryObject extends QueryObject
{
    const OBJECT_NAME = 'OrderItem';

    public function selectDiscounts(): DiscountQueryObject
    {
        $object = new DiscountQueryObject('discounts');
        $this->selectField($object);

        return $object;
    }

    public function selectEnteredOptions(): OrderItemOptionQueryObject
    {
        $object = new OrderItemOptionQueryObject('entered_options');
        $this->selectField($object);

        return $object;
    }

    public function selectGiftMessage(): GiftMessageQueryObject
    {
        $object = new GiftMessageQueryObject('gift_message');
        $this->selectField($object);

        return $object;
    }

    public function selectId(): self
    {
        $this->selectField('id');

        return $this;
    }

    public function selectPrices(): OrderItemPricesQueryObject
    {
        $object = new OrderItemPricesQueryObject('prices');
        $this->selectField($object);

        return $object;
    }

    public function selectProduct(): ProductInterfaceQueryObject
    {
        $object = new ProductInterfaceQueryObject('product');
        $this->selectField($object);

        return $object;
    }

    public function selectProductName(): self
    {
        $this->selectField('product_name');

        return $this;
    }

    public function selectProductSalePrice(): MoneyQueryObject
    {
        $object = new MoneyQueryObject('product_sale_price');
        $this->selectField($object);

        return $object;
    }

    public function selectProductSku(): self
    {
        $this->selectField('product_sku');

        return $this;
    }

    public function selectProductType(): self
    {
        selectField('product_type');

        return $this;
    }

    public function selectProductUrlKey(): self
    {
        $this->selectField('product_url_key');

        return $this;
    }

    public function selectQuantityCanceled(): self
    {
        $this->selectField('quantity_canceled');

        return $this;
    }

    public function selectQuantityInvoiced(): self
    {
        $this->selectField('quantity_invoiced');

        return $this;
    }

    public function selectQuantityOrdered(): self
    {
        $this->selectField('quantity_ordered');

        return $this;
    }

    public function selectQuantityRefunded(): self
    {
        $this->selectField('quantity_refunded');

        return $this;
    }

    public function selectQuantityReturned(): self
    {
        $this->selectField('quantity_returned');

        return $this;
    }

    public function selectQuantityShipped(): self
    {
        $this->selectField('quantity_shipped');

        return $this;
    }

    public function selectSelectedOptions(): OrderItemOptionQueryObject
    {
        $object = new OrderItemOptionQueryObject('selected_options');
        $this->selectField($object);

        return $object;
    }

    public function selectStatus(): self
    {
        $this->selectField('status');

        return $this;
    }
}
