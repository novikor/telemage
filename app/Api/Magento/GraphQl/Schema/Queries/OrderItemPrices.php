<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class OrderItemPrices
{
    public protected(set) ?ProductDiscount $catalog_discount = null;

    public protected(set) ?array $discounts = null;

    public protected(set) ?array $fixed_product_taxes = null;

    public protected(set) ?Money $original_item_price = null;

    public protected(set) ?Money $original_price = null;

    public protected(set) ?Money $original_price_including_tax = null;

    public protected(set) ?Money $original_row_total = null;

    public protected(set) ?Money $original_row_total_including_tax = null;

    public protected(set) ?Money $price = null;

    public protected(set) ?Money $price_including_tax = null;

    public protected(set) ?ProductDiscount $row_catalog_discount = null;

    public protected(set) ?Money $row_total = null;

    public protected(set) ?Money $row_total_including_tax = null;

    public protected(set) ?Money $total_item_discount = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['catalog_discount'])) {
            $instance->catalog_discount = ProductDiscount::fromArray($data['catalog_discount']);
        }
        if (isset($data['discounts'])) {
            $instance->discounts = array_map(Discount::fromArray(...), $data['discounts']);
        }
        if (isset($data['fixed_product_taxes'])) {
            $instance->fixed_product_taxes = array_map(FixedProductTax::fromArray(...), $data['fixed_product_taxes']);
        }
        if (isset($data['original_item_price'])) {
            $instance->original_item_price = Money::fromArray($data['original_item_price']);
        }
        if (isset($data['original_price'])) {
            $instance->original_price = Money::fromArray($data['original_price']);
        }
        if (isset($data['original_price_including_tax'])) {
            $instance->original_price_including_tax = Money::fromArray($data['original_price_including_tax']);
        }
        if (isset($data['original_row_total'])) {
            $instance->original_row_total = Money::fromArray($data['original_row_total']);
        }
        if (isset($data['original_row_total_including_tax'])) {
            $instance->original_row_total_including_tax = Money::fromArray($data['original_row_total_including_tax']);
        }
        if (isset($data['price'])) {
            $instance->price = Money::fromArray($data['price']);
        }
        if (isset($data['price_including_tax'])) {
            $instance->price_including_tax = Money::fromArray($data['price_including_tax']);
        }
        if (isset($data['row_catalog_discount'])) {
            $instance->row_catalog_discount = ProductDiscount::fromArray($data['row_catalog_discount']);
        }
        if (isset($data['row_total'])) {
            $instance->row_total = Money::fromArray($data['row_total']);
        }
        if (isset($data['row_total_including_tax'])) {
            $instance->row_total_including_tax = Money::fromArray($data['row_total_including_tax']);
        }
        if (isset($data['total_item_discount'])) {
            $instance->total_item_discount = Money::fromArray($data['total_item_discount']);
        }

        return $instance;
    }

    public static function fromJson(string $json): self
    {
        $data = json_decode($json, true);
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid JSON provided to fromJson method: '.json_last_error_msg());
        }

        return self::fromArray($data);
    }

    /**
     * Converts this object to an array.
     */
    public function asArray(): array
    {
        $data = [];
        if ($this->catalog_discount instanceof ProductDiscount) {
            $data['catalog_discount'] = $this->catalog_discount->asArray();
        }
        if ($this->discounts !== null) {
            $data['discounts'] = array_map(fn ($item) => $item->asArray(), $this->discounts);
        }
        if ($this->fixed_product_taxes !== null) {
            $data['fixed_product_taxes'] = array_map(fn ($item) => $item->asArray(), $this->fixed_product_taxes);
        }
        if ($this->original_item_price instanceof Money) {
            $data['original_item_price'] = $this->original_item_price->asArray();
        }
        if ($this->original_price instanceof Money) {
            $data['original_price'] = $this->original_price->asArray();
        }
        if ($this->original_price_including_tax instanceof Money) {
            $data['original_price_including_tax'] = $this->original_price_including_tax->asArray();
        }
        if ($this->original_row_total instanceof Money) {
            $data['original_row_total'] = $this->original_row_total->asArray();
        }
        if ($this->original_row_total_including_tax instanceof Money) {
            $data['original_row_total_including_tax'] = $this->original_row_total_including_tax->asArray();
        }
        if ($this->price instanceof Money) {
            $data['price'] = $this->price->asArray();
        }
        if ($this->price_including_tax instanceof Money) {
            $data['price_including_tax'] = $this->price_including_tax->asArray();
        }
        if ($this->row_catalog_discount instanceof ProductDiscount) {
            $data['row_catalog_discount'] = $this->row_catalog_discount->asArray();
        }
        if ($this->row_total instanceof Money) {
            $data['row_total'] = $this->row_total->asArray();
        }
        if ($this->row_total_including_tax instanceof Money) {
            $data['row_total_including_tax'] = $this->row_total_including_tax->asArray();
        }
        if ($this->total_item_discount instanceof Money) {
            $data['total_item_discount'] = $this->total_item_discount->asArray();
        }

        return $data;
    }
}
