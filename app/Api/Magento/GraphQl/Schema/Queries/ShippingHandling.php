<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class ShippingHandling
{
    public protected(set) ?Money $amount_excluding_tax = null;

    public protected(set) ?Money $amount_including_tax = null;

    /** @var ShippingDiscount[] */
    public protected(set) ?array $discounts = null;

    /** @var TaxItem[] */
    public protected(set) ?array $taxes = null;

    public protected(set) ?Money $total_amount = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['amount_excluding_tax'])) {
            $instance->amount_excluding_tax = Money::fromArray($data['amount_excluding_tax']);
        }
        if (isset($data['amount_including_tax'])) {
            $instance->amount_including_tax = Money::fromArray($data['amount_including_tax']);
        }
        if (isset($data['discounts'])) {
            $instance->discounts = array_map(ShippingDiscount::fromArray(...), $data['discounts']);
        }
        if (isset($data['taxes'])) {
            $instance->taxes = array_map(TaxItem::fromArray(...), $data['taxes']);
        }
        if (isset($data['total_amount'])) {
            $instance->total_amount = Money::fromArray($data['total_amount']);
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
        if ($this->amount_excluding_tax instanceof Money) {
            $data['amount_excluding_tax'] = $this->amount_excluding_tax->asArray();
        }
        if ($this->amount_including_tax instanceof Money) {
            $data['amount_including_tax'] = $this->amount_including_tax->asArray();
        }
        if ($this->discounts !== null) {
            $data['discounts'] = array_map(fn (ShippingDiscount $item) => $item->asArray(), $this->discounts);
        }
        if ($this->taxes !== null) {
            $data['taxes'] = array_map(fn (TaxItem $item) => $item->asArray(), $this->taxes);
        }
        if ($this->total_amount instanceof Money) {
            $data['total_amount'] = $this->total_amount->asArray();
        }

        return $data;
    }
}
