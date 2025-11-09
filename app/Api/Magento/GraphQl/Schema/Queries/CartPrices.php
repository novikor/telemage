<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class CartPrices
{
    public protected(set) ?array $applied_taxes = null;

    public protected(set) ?CartDiscount $discount = null;

    public protected(set) ?array $discounts = null;

    public protected(set) ?Money $grand_total = null;

    public protected(set) ?Money $grand_total_excluding_tax = null;

    public protected(set) ?Money $subtotal_excluding_tax = null;

    public protected(set) ?Money $subtotal_including_tax = null;

    public protected(set) ?Money $subtotal_with_discount_excluding_tax = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['applied_taxes']) && $data['applied_taxes'] !== null) {
            $instance->applied_taxes = array_map(CartTaxItem::fromArray(...), $data['applied_taxes']);
        }
        if (isset($data['discount']) && $data['discount'] !== null) {
            $instance->discount = CartDiscount::fromArray($data['discount']);
        }
        if (isset($data['discounts'])) {
            $instance->discounts = array_map(Discount::fromArray(...), $data['discounts']);
        }
        if (isset($data['grand_total'])) {
            $instance->grand_total = Money::fromArray($data['grand_total']);
        }
        if (isset($data['grand_total_excluding_tax']) && $data['grand_total_excluding_tax'] !== null) {
            $instance->grand_total_excluding_tax = Money::fromArray($data['grand_total_excluding_tax']);
        }
        if (isset($data['subtotal_excluding_tax']) && $data['subtotal_excluding_tax'] !== null) {
            $instance->subtotal_excluding_tax = Money::fromArray($data['subtotal_excluding_tax']);
        }
        if (isset($data['subtotal_including_tax']) && $data['subtotal_including_tax'] !== null) {
            $instance->subtotal_including_tax = Money::fromArray($data['subtotal_including_tax']);
        }
        if (isset($data['subtotal_with_discount_excluding_tax']) && $data['subtotal_with_discount_excluding_tax'] !== null) {
            $instance->subtotal_with_discount_excluding_tax = Money::fromArray($data['subtotal_with_discount_excluding_tax']);
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
        if ($this->applied_taxes !== null) {
            $data['applied_taxes'] = array_map(fn ($item) => $item->asArray(), $this->applied_taxes);
        }
        if ($this->discount instanceof CartDiscount) {
            $data['discount'] = $this->discount->asArray();
        }
        if ($this->discounts !== null) {
            $data['discounts'] = array_map(fn ($item) => $item->asArray(), $this->discounts);
        }
        if ($this->grand_total instanceof Money) {
            $data['grand_total'] = $this->grand_total->asArray();
        }
        if ($this->grand_total_excluding_tax instanceof Money) {
            $data['grand_total_excluding_tax'] = $this->grand_total_excluding_tax->asArray();
        }
        if ($this->subtotal_excluding_tax instanceof Money) {
            $data['subtotal_excluding_tax'] = $this->subtotal_excluding_tax->asArray();
        }
        if ($this->subtotal_including_tax instanceof Money) {
            $data['subtotal_including_tax'] = $this->subtotal_including_tax->asArray();
        }
        if ($this->subtotal_with_discount_excluding_tax instanceof Money) {
            $data['subtotal_with_discount_excluding_tax'] = $this->subtotal_with_discount_excluding_tax->asArray();
        }

        return $data;
    }
}
