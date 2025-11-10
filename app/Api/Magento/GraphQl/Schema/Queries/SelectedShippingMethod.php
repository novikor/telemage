<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class SelectedShippingMethod
{
    public protected(set) ?Money $amount = null;

    public protected(set) ?Money $base_amount = null;

    public protected(set) ?string $carrier_code = null;

    public protected(set) ?string $carrier_title = null;

    public protected(set) ?string $method_code = null;

    public protected(set) ?string $method_title = null;

    public protected(set) ?Money $price_excl_tax = null;

    public protected(set) ?Money $price_incl_tax = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['amount'])) {
            $instance->amount = Money::fromArray($data['amount']);
        }
        if (isset($data['base_amount'])) {
            $instance->base_amount = Money::fromArray($data['base_amount']);
        }
        if (isset($data['carrier_code'])) {
            $instance->carrier_code = $data['carrier_code'];
        }
        if (isset($data['carrier_title'])) {
            $instance->carrier_title = $data['carrier_title'];
        }
        if (isset($data['method_code'])) {
            $instance->method_code = $data['method_code'];
        }
        if (isset($data['method_title'])) {
            $instance->method_title = $data['method_title'];
        }
        if (isset($data['price_excl_tax'])) {
            $instance->price_excl_tax = Money::fromArray($data['price_excl_tax']);
        }
        if (isset($data['price_incl_tax'])) {
            $instance->price_incl_tax = Money::fromArray($data['price_incl_tax']);
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
        if ($this->amount instanceof Money) {
            $data['amount'] = $this->amount->asArray();
        }
        if ($this->base_amount instanceof Money) {
            $data['base_amount'] = $this->base_amount->asArray();
        }
        if ($this->carrier_code !== null) {
            $data['carrier_code'] = $this->carrier_code;
        }
        if ($this->carrier_title !== null) {
            $data['carrier_title'] = $this->carrier_title;
        }
        if ($this->method_code !== null) {
            $data['method_code'] = $this->method_code;
        }
        if ($this->method_title !== null) {
            $data['method_title'] = $this->method_title;
        }
        if ($this->price_excl_tax instanceof Money) {
            $data['price_excl_tax'] = $this->price_excl_tax->asArray();
        }
        if ($this->price_incl_tax instanceof Money) {
            $data['price_incl_tax'] = $this->price_incl_tax->asArray();
        }

        return $data;
    }
}
