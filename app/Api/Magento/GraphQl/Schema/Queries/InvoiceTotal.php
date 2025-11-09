<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class InvoiceTotal
{
    public protected(set) ?Money $base_grand_total = null;

    public protected(set) ?array $discounts = null;

    public protected(set) ?Money $grand_total = null;

    public protected(set) ?ShippingHandling $shipping_handling = null;

    public protected(set) ?Money $subtotal = null;

    public protected(set) ?array $taxes = null;

    public protected(set) ?Money $total_shipping = null;

    public protected(set) ?Money $total_tax = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['base_grand_total'])) {
            $instance->base_grand_total = Money::fromArray($data['base_grand_total']);
        }
        if (isset($data['discounts'])) {
            $instance->discounts = array_map(Discount::fromArray(...), $data['discounts']);
        }
        if (isset($data['grand_total'])) {
            $instance->grand_total = Money::fromArray($data['grand_total']);
        }
        if (isset($data['shipping_handling'])) {
            $instance->shipping_handling = ShippingHandling::fromArray($data['shipping_handling']);
        }
        if (isset($data['subtotal']) && $data['subtotal'] !== null) {
            $instance->subtotal = Money::fromArray($data['subtotal']);
        }
        if (isset($data['taxes'])) {
            $instance->taxes = array_map(TaxItem::fromArray(...), $data['taxes']);
        }
        if (isset($data['total_shipping']) && $data['total_shipping'] !== null) {
            $instance->total_shipping = Money::fromArray($data['total_shipping']);
        }
        if (isset($data['total_tax']) && $data['total_tax'] !== null) {
            $instance->total_tax = Money::fromArray($data['total_tax']);
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
        if ($this->base_grand_total instanceof Money) {
            $data['base_grand_total'] = $this->base_grand_total->asArray();
        }
        if ($this->discounts !== null) {
            $data['discounts'] = array_map(fn ($item) => $item->asArray(), $this->discounts);
        }
        if ($this->grand_total instanceof Money) {
            $data['grand_total'] = $this->grand_total->asArray();
        }
        if ($this->shipping_handling instanceof ShippingHandling) {
            $data['shipping_handling'] = $this->shipping_handling->asArray();
        }
        if ($this->subtotal instanceof Money) {
            $data['subtotal'] = $this->subtotal->asArray();
        }
        if ($this->taxes !== null) {
            $data['taxes'] = array_map(fn ($item) => $item->asArray(), $this->taxes);
        }
        if ($this->total_shipping instanceof Money) {
            $data['total_shipping'] = $this->total_shipping->asArray();
        }
        if ($this->total_tax instanceof Money) {
            $data['total_tax'] = $this->total_tax->asArray();
        }

        return $data;
    }
}
