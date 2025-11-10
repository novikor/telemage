<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use InvalidArgumentException;

class CustomerOrder
{
    /** @var AppliedCoupon[] */
    public protected(set) ?array $applied_coupons = null;

    /** @var OrderActionTypeEnumObject[] */
    public protected(set) ?array $available_actions = null;

    public protected(set) ?OrderAddress $billing_address = null;

    public protected(set) ?string $carrier = null;

    /** @var SalesCommentItem[] */
    public protected(set) ?array $comments = null;

    public protected(set) ?Carbon $created_at = null;

    /** @var CreditMemo[] */
    public protected(set) ?array $credit_memos = null;

    public protected(set) ?OrderCustomerInfo $customer_info = null;

    public protected(set) ?string $email = null;

    public protected(set) ?GiftMessage $gift_message = null;

    public protected(set) ?float $grand_total = null;

    public protected(set) ?string $id = null;

    public protected(set) ?string $increment_id = null;

    /** @var Invoice[] */
    public protected(set) ?array $invoices = null;

    public protected(set) ?bool $is_virtual = null;

    /** @var mixed[] */
    public protected(set) ?array $items = null;

    public protected(set) ?string $number = null;

    public protected(set) ?Carbon $order_date = null;

    public protected(set) ?string $order_number = null;

    public protected(set) ?string $order_status_change_date = null;

    /** @var OrderPaymentMethod[] */
    public protected(set) ?array $payment_methods = null;

    /** @var OrderShipment[] */
    public protected(set) ?array $shipments = null;

    public protected(set) ?OrderAddress $shipping_address = null;

    public protected(set) ?string $shipping_method = null;

    public protected(set) ?string $status = null;

    public protected(set) ?string $token = null;

    public protected(set) ?OrderTotal $total = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['applied_coupons'])) {
            $instance->applied_coupons = array_map(AppliedCoupon::fromArray(...), $data['applied_coupons']);
        }
        if (isset($data['available_actions'])) {
            $instance->available_actions = $data['available_actions'];
        }
        if (isset($data['billing_address'])) {
            $instance->billing_address = OrderAddress::fromArray($data['billing_address']);
        }
        if (isset($data['carrier'])) {
            $instance->carrier = $data['carrier'];
        }
        if (isset($data['comments'])) {
            $instance->comments = array_map(SalesCommentItem::fromArray(...), $data['comments']);
        }
        if (isset($data['created_at'])) {
            $instance->created_at = Date::create($data['created_at']);
        }
        if (isset($data['credit_memos'])) {
            $instance->credit_memos = array_map(CreditMemo::fromArray(...), $data['credit_memos']);
        }
        if (isset($data['customer_info'])) {
            $instance->customer_info = OrderCustomerInfo::fromArray($data['customer_info']);
        }
        if (isset($data['email'])) {
            $instance->email = $data['email'];
        }
        if (isset($data['gift_message'])) {
            $instance->gift_message = GiftMessage::fromArray($data['gift_message']);
        }
        if (isset($data['grand_total'])) {
            $instance->grand_total = $data['grand_total'];
        }
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['increment_id'])) {
            $instance->increment_id = $data['increment_id'];
        }
        if (isset($data['invoices'])) {
            $instance->invoices = array_map(Invoice::fromArray(...), $data['invoices']);
        }
        if (isset($data['is_virtual'])) {
            $instance->is_virtual = $data['is_virtual'];
        }
        if (isset($data['items']) && is_array($data['items']) && array_is_list($data['items'])) {
            $instance->items = array_map(OrderItem::fromArray(...), $data['items']);
        }
        if (isset($data['number'])) {
            $instance->number = $data['number'];
        }
        if (isset($data['order_date'])) {
            $instance->order_date = Date::create($data['order_date']);
        }
        if (isset($data['order_number'])) {
            $instance->order_number = $data['order_number'];
        }
        if (isset($data['order_status_change_date'])) {
            $instance->order_status_change_date = $data['order_status_change_date'];
        }
        if (isset($data['payment_methods'])) {
            $instance->payment_methods = array_map(OrderPaymentMethod::fromArray(...), $data['payment_methods']);
        }
        if (isset($data['shipments'])) {
            $instance->shipments = array_map(OrderShipment::fromArray(...), $data['shipments']);
        }
        if (isset($data['shipping_address'])) {
            $instance->shipping_address = OrderAddress::fromArray($data['shipping_address']);
        }
        if (isset($data['shipping_method'])) {
            $instance->shipping_method = $data['shipping_method'];
        }
        if (isset($data['status'])) {
            $instance->status = $data['status'];
        }
        if (isset($data['token'])) {
            $instance->token = $data['token'];
        }
        if (isset($data['total'])) {
            $instance->total = OrderTotal::fromArray($data['total']);
        }

        return $instance;
    }

    public static function fromJson(string $json): self
    {
        $data = json_decode($json, true);
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException('Invalid JSON provided to fromJson method: '.json_last_error_msg());
        }

        return self::fromArray($data);
    }

    /**
     * Converts this object to an array.
     */
    public function asArray(): array
    {
        $data = [];
        if ($this->applied_coupons !== null) {
            $data['applied_coupons'] = array_map(fn (AppliedCoupon $item) => $item->asArray(), $this->applied_coupons);
        }
        if ($this->available_actions !== null) {
            $data['available_actions'] = $this->available_actions;
        }
        if ($this->billing_address instanceof OrderAddress) {
            $data['billing_address'] = $this->billing_address->asArray();
        }
        if ($this->carrier !== null) {
            $data['carrier'] = $this->carrier;
        }
        if ($this->comments !== null) {
            $data['comments'] = array_map(fn (SalesCommentItem $item) => $item->asArray(), $this->comments);
        }
        if ($this->created_at instanceof Carbon) {
            $data['created_at'] = $this->created_at->toIso8601String();
        }
        if ($this->credit_memos !== null) {
            $data['credit_memos'] = array_map(fn (CreditMemo $item) => $item->asArray(), $this->credit_memos);
        }
        if ($this->customer_info instanceof OrderCustomerInfo) {
            $data['customer_info'] = $this->customer_info->asArray();
        }
        if ($this->email !== null) {
            $data['email'] = $this->email;
        }
        if ($this->gift_message instanceof GiftMessage) {
            $data['gift_message'] = $this->gift_message->asArray();
        }
        if ($this->grand_total !== null) {
            $data['grand_total'] = $this->grand_total;
        }
        if ($this->id !== null) {
            $data['id'] = $this->id;
        }
        if ($this->increment_id !== null) {
            $data['increment_id'] = $this->increment_id;
        }
        if ($this->invoices !== null) {
            $data['invoices'] = array_map(fn (Invoice $item) => $item->asArray(), $this->invoices);
        }
        if ($this->is_virtual !== null) {
            $data['is_virtual'] = $this->is_virtual;
        }
        if ($this->items !== null) {
            $data['items'] = $this->items;
        }
        if ($this->number !== null) {
            $data['number'] = $this->number;
        }
        if ($this->order_date instanceof Carbon) {
            $data['order_date'] = $this->order_date;
        }
        if ($this->order_number !== null) {
            $data['order_number'] = $this->order_number;
        }
        if ($this->order_status_change_date !== null) {
            $data['order_status_change_date'] = $this->order_status_change_date;
        }
        if ($this->payment_methods !== null) {
            $data['payment_methods'] = array_map(fn (OrderPaymentMethod $item) => $item->asArray(), $this->payment_methods);
        }
        if ($this->shipments !== null) {
            $data['shipments'] = array_map(fn (OrderShipment $item) => $item->asArray(), $this->shipments);
        }
        if ($this->shipping_address instanceof OrderAddress) {
            $data['shipping_address'] = $this->shipping_address->asArray();
        }
        if ($this->shipping_method !== null) {
            $data['shipping_method'] = $this->shipping_method;
        }
        if ($this->status !== null) {
            $data['status'] = $this->status;
        }
        if ($this->token !== null) {
            $data['token'] = $this->token;
        }
        if ($this->total instanceof OrderTotal) {
            $data['total'] = $this->total->asArray();
        }

        return $data;
    }
}
