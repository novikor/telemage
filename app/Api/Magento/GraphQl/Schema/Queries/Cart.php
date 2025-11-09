<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class Cart
{
    public protected(set) ?AppliedCoupon $applied_coupon = null;

    public protected(set) ?array $applied_coupons = null;

    public protected(set) ?array $available_payment_methods = null;

    public protected(set) ?BillingCartAddress $billing_address = null;

    public protected(set) ?string $email = null;

    public protected(set) ?GiftMessage $gift_message = null;

    public protected(set) ?string $id = null;

    public protected(set) ?bool $is_virtual = null;

    public protected(set) ?array $items = null;

    public protected(set) ?CartItems $itemsV2 = null;

    public protected(set) ?CartPrices $prices = null;

    public protected(set) ?SelectedPaymentMethod $selected_payment_method = null;

    public protected(set) ?array $shipping_addresses = null;

    public protected(set) ?float $total_quantity = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['applied_coupon']) && $data['applied_coupon'] !== null) {
            $instance->applied_coupon = AppliedCoupon::fromArray($data['applied_coupon']);
        }
        if (isset($data['applied_coupons']) && $data['applied_coupons'] !== null) {
            $instance->applied_coupons = array_map(AppliedCoupon::fromArray(...), $data['applied_coupons']);
        }
        if (isset($data['available_payment_methods']) && $data['available_payment_methods'] !== null) {
            $instance->available_payment_methods = array_map(AvailablePaymentMethod::fromArray(...), $data['available_payment_methods']);
        }
        if (isset($data['billing_address']) && $data['billing_address'] !== null) {
            $instance->billing_address = BillingCartAddress::fromArray($data['billing_address']);
        }
        if (isset($data['email']) && $data['email'] !== null) {
            $instance->email = $data['email'];
        }
        if (isset($data['gift_message']) && $data['gift_message'] !== null) {
            $instance->gift_message = GiftMessage::fromArray($data['gift_message']);
        }
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['is_virtual']) && $data['is_virtual'] !== null) {
            $instance->is_virtual = $data['is_virtual'];
        }
        if (isset($data['items'])) {
            $instance->items = $data['items'];
        }
        if (isset($data['itemsV2']) && $data['itemsV2'] !== null) {
            $instance->itemsV2 = CartItems::fromArray($data['itemsV2']);
        }
        if (isset($data['prices']) && $data['prices'] !== null) {
            $instance->prices = CartPrices::fromArray($data['prices']);
        }
        if (isset($data['selected_payment_method']) && $data['selected_payment_method'] !== null) {
            $instance->selected_payment_method = SelectedPaymentMethod::fromArray($data['selected_payment_method']);
        }
        if (isset($data['shipping_addresses']) && $data['shipping_addresses'] !== null) {
            $instance->shipping_addresses = array_map(ShippingCartAddress::fromArray(...), $data['shipping_addresses']);
        }
        if (isset($data['total_quantity']) && $data['total_quantity'] !== null) {
            $instance->total_quantity = $data['total_quantity'];
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
        if ($this->applied_coupon instanceof AppliedCoupon) {
            $data['applied_coupon'] = $this->applied_coupon->asArray();
        }
        if ($this->applied_coupons !== null) {
            $data['applied_coupons'] = array_map(fn ($item) => $item->asArray(), $this->applied_coupons);
        }
        if ($this->available_payment_methods !== null) {
            $data['available_payment_methods'] = array_map(fn ($item) => $item->asArray(), $this->available_payment_methods);
        }
        if ($this->billing_address instanceof BillingCartAddress) {
            $data['billing_address'] = $this->billing_address->asArray();
        }
        if ($this->email !== null) {
            $data['email'] = $this->email;
        }
        if ($this->gift_message instanceof GiftMessage) {
            $data['gift_message'] = $this->gift_message->asArray();
        }
        if ($this->id !== null) {
            $data['id'] = $this->id;
        }
        if ($this->is_virtual !== null) {
            $data['is_virtual'] = $this->is_virtual;
        }
        if ($this->items !== null) {
            $data['items'] = $this->items;
        }
        if ($this->itemsV2 instanceof CartItems) {
            $data['itemsV2'] = $this->itemsV2->asArray();
        }
        if ($this->prices instanceof CartPrices) {
            $data['prices'] = $this->prices->asArray();
        }
        if ($this->selected_payment_method instanceof SelectedPaymentMethod) {
            $data['selected_payment_method'] = $this->selected_payment_method->asArray();
        }
        if ($this->shipping_addresses !== null) {
            $data['shipping_addresses'] = array_map(fn ($item) => $item->asArray(), $this->shipping_addresses);
        }
        if ($this->total_quantity !== null) {
            $data['total_quantity'] = $this->total_quantity;
        }

        return $data;
    }
}
